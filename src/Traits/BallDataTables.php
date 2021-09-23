<?php

namespace morkcode\Ball\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\WithPagination;
use Illuminate\Support\Arr;

/**
 * BallDataTables
 * @todo
 *  * Testear con relaciones
 *
 *  - Search:
 *      - Solo con mas de 3 Caracteres ???
 *      - Terms separate falta para Relaciones OK?
 *  - Sort:
 *      - for more than one field with SHIFT key
 *      - En Rows terminar Funcion
 *  - Pagination:
 *      - ver perPage q hay problemas ??? OK???  $recordsPerPage
 * Based on
 * @see https://github.com/livewire/livewire/discussions/2788
 */
trait BallDataTables
{
    use WithPagination {
        getQueryString as paginationGetQueryString;
    }

    /**
     * BALL - Default values
     */
    public $sortingEnabled      = true;
    public $searchingEnabled    = true;
    public $paginationEnabled   = true;

    // PatchBALL ??? public $offlineIndicator    = true;

    public array $perPageAccepted = [] ;
    // for Search
    public int $searchType      = 1;
    protected array $words      = [];
    protected string $word      = '';
    // for Sorts
    public array $sorts         = [];
    // ./BALL

    /**
     * perPage
     */
    public int $perPage = 10;

    public ?string $q = null;
    public string $sortBy = '';
    public string $sort = 'asc';

    public array $filters = [];

    /**
     * initializeBallDataTables
     *
     * @return void
     */
    public function initializeBallDataTables()
    {
        $this->filters = $this->getFilters();
    }

    // BALL recordsPage
    public function perPageAccepted()
    {
        $recordsPerPage = 10;
        if( isset( $this->recordsPerPage  ) ) {
            $recordsPerPage =  $this->recordsPerPage;
        }
        // PatchBALL ???
        return $this->perPageAccepted = [$recordsPerPage, $recordsPerPage * 2 , $recordsPerPage * 4 ];
    }

    /**
     * getQueryString
     *
     * @return void
     */
    public function getQueryString()
    {
        $qs = $this->paginationGetQueryString();

        $reflection = new \ReflectionClass($this);
        $defaults = $reflection->getDefaultProperties();


        return array_merge([
            'perPage',
            'q',
            'sortBy',
            'sort' ,
            'filters',
        ], $qs);

        // return array_merge([
        //     'perPage' => ['except' => $defaults['perPage']],
        //     'q'       => ['except' => $defaults['q']],
        //     'sortBy'  => ['except' => $defaults['sortBy']],
        //     'sort'    => ['except' => $defaults['sort']],
        //     'filters' => ['except' => $this->getFilters()],
        // ], $qs);
    }

    /**
     * getSearchableColumns
     *
     * @param Builder $q
     * @return array
     */
    protected function getSearchableColumns(Builder $q): array
    {
        // PatchBALL
        // @todo Ver de reemplazar ID por un Alias????

        if( empty( $this->getColumns() )) {
            // All model columns
            $columns = \Schema::connection($q->getModel()->getConnectionName())
                ->getColumnListing($q->getModel()->getTable());
        }
        else {
            // Defined columns
            $columns = $this->getColumnsByAttribute( 'searchable' );
        }

        // Remove model hidden columns
        $columns = array_diff($columns, $q->getModel()->getHidden());

        // Remove model datetime casts columns
        $columns = array_diff($columns, [
            ...$q->getModel()->getDates(),
            ...array_keys(array_filter($q->getModel()->getCasts(), fn($i) => $i === 'datetime')),
        ]);

        return $columns;
    }

    /**
     * getFilters
     *
     * @return array
     */
    protected function getFilters(): array
    {
        return [];
    }

    public function updatedPerPage() { $this->resetPage(); }

    public function updatedFilters() { $this->resetPage(); }

    public function updatedQ() { $this->resetPage(); }

    /**
     * resetSearch
     *
     * @return void
     */
    public function resetSearch()
    {
        $this->reset('q');
        $this->reset('searchType');
        $this->resetPage();
    }

    public function sortClass( $field )
    {
        return  Arr::exists($this->sorts, $field ) ? true : false;
    }

    /**
     * sortOrderView
     *
     * @param mixed $field
     * @param mixed $direction
     * @return string void
     */
    public function sortOrderView( $field, $direction )
    {
        if( empty( $direction ) ) {
            if( Arr::exists($this->sorts, $field ) ) {
                $values = Arr::only($this->sorts, [ $field ]);
                return $values[$field];
            }
        }
        return $direction;
    }

    /**
     * sortBy
     *
     * @param mixed $field
     * @return
     */
    public function sortBy($field)
    {
        if (! $this->sortingEnabled) {
            return null;
        }

        if ($this->sortBy === $field) {
            $this->sort = ($this->sort === 'asc' ? 'desc' : 'asc');
        } else {
            $this->sort = 'asc';
        }
        $this->sortBy = $field;
    }

    /**
     * handleFilter
     *
     * @param Builder $q
     * @return Builder
     */
    protected function handleFilter(Builder $q): Builder
    {
        if (!count($this->filters)) {
            return $q;
        }

        $baseTable = $q->getQuery()->from;

        return $q->where(function (Builder $q) use ($baseTable) {
            foreach ($this->filters as $column => $value) {
                if ($value === null || $value === 'dt-ignore') {
                    continue;
                }

                if ($value === 'dt-null') {
                    $value = null;
                }

                $op = '=';

                if ($value === 'dt-not-null') {
                    $op = '!=';
                }

                if (str_contains($column, '->')) {
                    [$relationName, $field] = explode('->', $this->sortBy);
                    $q->whereHas($relationName, function (Builder $cq) use ($field, $value, $op) {
                        $cq->where($field, $op, $value);
                    });
                    continue;
                }


                if (str_starts_with($column, '@')) {
                    $q->where(substr($column, 1), $op, $value);
                    continue;
                }

                $column = (str_contains($column, '.') ? '' : $baseTable . '.') . $column;
                $q->where($column, $op, $value);
            }
        });
    }

    /**
     * handleSearch
     *
     * @param Builder $q
     * @return Builder
     */
    protected function handleSearch(Builder $q): Builder
    {
        if (!$this->q ) {
            return $q;
        }
        /**
         * $searchType :
         *      1 = all of the words. LIKE %word% OR %word% AND %word%
         *      2 = the exact phrase as substring. LIKE %many words%
         *      3 = the phrase begin as. - LIKE word%
         *      4 = the exact phrase as whole field. - LIKE 'the phase'
         *
         * Is searchType is 1 (all words like %%) and the search have spaces (not at begining or end), build the array of words
         */
        if ($this->searchType === 1 && $this->q == trim($this->q) && strpos($this->q, ' ') !== false ) {
            $this->words = explode(" ", trim($this->q));
        }

        $columns = $this->getSearchableColumns($q);

        $baseTable = $q->getQuery()->from;

        if( count( $this->words ) === 0 ) {
            $this->words = [ trim($this->q) ];
        }
        // Loop words
        foreach ($this->words as &$word)  {
            switch ($this->searchType) {
                case 1:     // all of the words - LIKE %word%
                case 2:     // the exact phrase as substring. - LIKE exact phrase%
                    $this->word = '%' . $word  . '%';
                    break;
                case 3:     // the phrase begin as. - LIKE word%
                    $this->word = $word  . '%';
                    break;
                case 4:     // the exact phrase as whole field. - LIKE 'the phase'
                    $this->word = $word;
                    break;
            }
            // Build search loop by column
            $buildsearch = $q->where(function (Builder $q) use ($columns, $baseTable) {
                foreach ($columns as $column) {
                    // ***
                    if (str_contains($column, '->')) {
                        [$relationName, $field] = explode('->', $column);

                        $q->orWhereHas($relationName, function (Builder $cq) use ($field) {
                            $cq->where($field, 'LIKE', $this->word );
                        });
                        continue;
                    }

                    if (str_starts_with($column, '@')) {
                        $q->orWhere(substr($column, 1), 'LIKE', $this->word );
                        continue;
                    }

                    $column = (str_contains($column, '.') ? '' : $baseTable . '.') . $column;
                    $q->orWhere($column, 'LIKE', $this->word );
                }
                $this->word = '';
            });
        }
        $this->words = [];
        return $buildsearch;
    }

    /**
     * validateSorts
     *
     * @return bool
     */
    protected function validateSorts()
    {
        $fieldsSortable = $this->getColumnsByAttribute( 'sortable' ) ;
        foreach( $this->sorts as $sort => $value ) {
            if( ! in_array( $sort, $fieldsSortable ) ) {
                return false;
            }
        }
        return true;
    }

    /**
     * handleSort
     *
     * @param Builder $q
     * @return Builder
     */
    protected function handleSort(Builder $q): Builder
    {
        if (! $this->sortingEnabled) {
            return $q;
        }

        if( count( $this->sorts ) === 0 ) {
            if( empty( $this->sortBy ) ) {
                // Agregar si existe esta declarado initialSortColumns
                if ( empty( $this->initialSortColumns ) ) {
                    \Log::info('***** NO TIENE initialSortColumns sortBy EMPTY');
                }
                else {
                    // get initialSortColumns
                    $this->sorts = $this->initialSortColumns;
                    // PatchBALL perPage ???
                    if( $this->perPage === 10 ) {
                        $this->perPage = $this->recordsPerPage;
                    }
                }
            }
            else {
                \Log::info('NO Array sortBy ESTA PONE sortBy en Array $this->sortBy ');
                $this->sorts = [ $this->sortBy => $this->sort ];
            }
        }
        else {
            if( empty( $this->sortBy ) ) {
                \Log::info('                                            SI Array  sortBy EMPTY ');

            }
            else {
                if ( count( $this->sorts ) === 1 ) {
                    \Log::info('SI 1 Array sortBy NOT EMPTY');
                }
                else {
                    \Log::info('SI 2 Array sortBy NOT EMPTY');
                }
                $this->sorts = [ $this->sortBy => $this->sort ];
            }
        }

        // Valida Orden Permitido false por defecto
        if( ! $this->validateSorts() ) {
            \Log::info('ENTRA validateSorts ');
            $this->sorts = $this->initialSortColumns;
            if( $this->perPage === 10 ) {
                $this->perPage = $this->recordsPerPage;
            }
        }
        // \Log::info( '
        // == handleSort =======> sortBy : ' . $this->sortBy . ' countSorts[]: ' . count( $this->sorts ) . ' sorts[]: ' . json_encode( $this->sorts ) );
        \Log::info( json_encode( $this->q ));

        \Log::info( json_encode( $q ));
        \Log::info( json_encode( '======' ));
        \Log::info( json_encode( $this->sorts ));
        // Loop
        foreach ($this->sorts as $sortBy => &$sort) {



            \Log::info( json_encode( $q ));
            // A DEFINIR @alias_
            // ==============
            // If sorting by alias column
            if (str_starts_with($sortBy, '@')) {
                return $q->orderBy(substr($sortBy, 1), $sort);
            }

            $baseTable = $q->getQuery()->from;

            // If sorting by relation
            if (str_contains($sortBy, '->')) {
                [$relationName, $field] = explode('->', $sortBy);

                /** @var Relation $relation */
                $relation = $q->getModel()->{$relationName}();
                $relatedTable = $relation->getRelated()->getTable();
                $q->orderBy("$relatedTable.$field", $sort);
            }
            else {
                // Sorting by column on base table
                $sortField = (str_contains($sortBy, '.') ? '' : $baseTable . '.') . $sortBy;
                $q->orderBy($sortField, $sort);
            }
        }
        \Log::info( json_encode( '======' ));
        return $q;
    }

    /**
     * getRelations
     *
     * @param Builder $q
     * @return Builder
     */
    protected function getRelations(Builder $q): Builder
    {
        // @todo PatchBALL Obtener valor sin variables
        if( isset( $this->setRelations ) ) {

            foreach( $this->setRelations as $relationName ) {

                $baseTable = $q->getQuery()->from;

                $relation = $q->getModel()->{$relationName}();
                $relatedTable = $relation->getRelated()->getTable();
                $relatedKey = $relation->getRelated()->getKeyName();
                $foreignKey = $relation->getForeignKeyName();

                switch (get_class($relation)) {
                    case BelongsTo::class:
                        $q->join($relatedTable, "$relatedTable.$relatedKey", '=', "$baseTable.$foreignKey");
                        break;
                    case HasOne::class:
                        // TODO: does this thing work?
                        $q->join($relatedTable, "$relatedTable.$foreignKey", '=', "$baseTable.$relatedKey");
                        break;
                }
            }
        }
        return $q;
    }

    /**
     * setQuery
     *
     * @param Builder $q
     * @return LengthAwarePaginator
     */
    protected function setQuery(Builder $q): LengthAwarePaginator
    {
        // not relations define columns
        if( ! isset( $this->setRelations )) {
            $q->select($this->getColumnsByAttribute( 'field' ));
        }
        // get all columns if not defined
        if (!$q->getQuery()->columns) {
            $q->select($q->getQuery()->from . '.*');
        }

        $q = $this->getRelations($q);

        $q = $this->handleFilter($q);

        $q = $this->handleSearch($q);

        $q = $this->handleSort($q);

        return $q->paginate($this->perPage);
    }

    /**
     * getColumns
     *
     * @return array
     */
    protected function getColumns(): array
    {
        return $this->mainColumns;
    }

    /**
     * setColumns
     *
     * @return array
     */
    protected function setColumns(): array
    {
        return json_decode(json_encode( $this->getColumns() ));
    }

    /**
     * getColumnsByAttribute
     * @todo Ver que hacer
     * - Return the columns that contain the attribute
     *
     * @param string $attrib
     * @return ar
     */
    protected function getColumnsByAttribute( $attrib ): array
    {
        $fieldsarebool = ['visible','searchable','sortable'];
        foreach( $this->setColumns() as $column) {
            if( isset( $column->$attrib ) ) {
                // for bool
                if( in_array( $attrib, $fieldsarebool ) ) {
                    if( is_true( $column->$attrib ) ) {
                        $attributesColumns[] = $column->field;
                    }
                }
                else {
                    $attributesColumns[] = $column->field;
                }
            }
        }
        return $attributesColumns ?? null;
    }

    /** BALL only For DEBUG ================================================================== */
    /**
     * totalWidthColumns
     * Only for DEBUG
     * @param array $columns
     * @return void
     */
    public function totalWidthColumns( )
    {
        $width = array_column( $this->getColumns(), 'width');
        $totalwidth = array_sum( $width );

        if(isset( $this->actionsWidth ) ) {
            $actionsWidth = '<td>Actions width<br>' . $this->actionsWidth . ' % '.'</td>';
            $showMissing = (100 - ($totalwidth + $this->actionsWidth ));
        }
        else {
            $actionsWidth = '';
            $showMissing = (100 - ($totalwidth));
        }
        return  '<table class="table table-bordered table-sm text-sm table-danger">'.
                '<tr class="text-center">'.
                '<td>Columns<br>' . count( array_column( $this->getColumns(), 'field') ) . '</td>'.
                '<td>Width columns<br>' . count( $width ) .'</td>'.
                '<td>Total width<br>' . $totalwidth . ' %' .'</td>'. $actionsWidth .
                '<td> * Missing * <br><span class="text-danger text-bold">' . $showMissing . ' % </span></th>'.
                '</tr></table>';
    }
}
