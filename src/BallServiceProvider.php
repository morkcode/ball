<?php

namespace morkcode\Ball;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

use morkcode\Ball\Commands\BallClear;
use morkcode\Ball\Commands\MakeTable;
use morkcode\Ball\Commands\MakeCrud;

// use morkcode\Ball\Components\Modals;
// use Livewire\Livewire;

// PatchBall VER si sirve
// use Illuminate\Views\Component as IlluminateComponent;
// use Illuminate\Views\Compilers\BladeCompiler;


class BallServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        $this->publishes([__DIR__ . '/../config/config.php' => config_path('ball.php')], 'ball-config');


        // PatchBall
        $this->publishes([__DIR__ . '/../resources/views' => resource_path('views/vendor/ball')], 'ball-views');
        

        $this->bootViews();

        // PatchBall VER si sirve
        // $this->prefixComponents();

        // $this->loadClassComponents();
        // $this->loadLivewireComponents();


        $this->loadCommands();


    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'ball');
    }

    protected function bootViews()
    {
        // PatchBall
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'ball');
        
        /** Components */
        // Root
        Blade::component('ball::components.contentheader', 'ball-contentheader');

        // Widget
        Blade::component('ball::components.widget.card', 'ball-card');
        Blade::component('ball::components.widget.icon', 'ball-icon');

        // Form
        Blade::component('ball::components.form.button', 'ball-button');
        Blade::component('ball::components.form.abutton', 'ball-abutton');
        Blade::component('ball::components.form.button-tools', 'ball-button-tools');

        Blade::component('ball::components.form.col', 'ball-col');
        Blade::component('ball::components.form.label', 'ball-label');
        Blade::component('ball::components.form.error', 'ball-error');
        Blade::component('ball::components.form.input', 'ball-input');
        Blade::component('ball::components.form.select', 'ball-select');
        Blade::component('ball::components.form.switch', 'ball-switch');
        Blade::component('ball::components.form.check-switch', 'ball-check-switch');

        Blade::component('ball::components.form.crud-form', 'ball-crud-form');
        Blade::component('ball::components.form.crud-buttons', 'ball-crud-buttons');
        // Tools
        // Blade::component('ball::components.tools.modal', 'ball-modal');
        Blade::component('ball::components.tools.date', 'ball-date');

        // Blade::component('ball::components.modals', 'modals');

        // Menu
        Blade::component('ball::components.menu.menu', 'ball-menu');
        Blade::component('ball::components.menu.submenu', 'ball-menu-submenu');
        // Dtable Components

        // Table Components
        Blade::component('ball::components.table.table', 'ball-table');
        Blade::component('ball::components.table.thead', 'ball-thead');
        Blade::component('ball::components.table.tdrow', 'ball-tdrow');



        // Livewire::component('ball::modals', Modals::class);

    }

    // private function loadLivewireComponents(): void
    // {
    //     // $this->loadViewComponentsAs('ball-modals', [
    //     //     Modals::class,
    //     // ]);
    //     Livewire::component('modals', Modals::class);
    // }

    // private function loadClassComponents(): void
    // {
    //     $this->loadViewComponentsAs('ball-modals', [
    //         Modals::class,
    //     ]);
    //     Livewire::component('modals', Modals::class);
    // }

    // // PatchBall VER si sirve
    // private function prefixComponents(): void
    // {
    //     $this->callAfterResolving(BladeCompiler::class, function (BladeCompiler $blade) {
    //         $prefix = 'ball';
    //         /** @var IlluminateComponent $component */
    //         foreach (config('ball.components', []) as $alias => $component) {
    //             $blade->component($component, $alias, $prefix);
    //         }
    //     });
    // }

    private function loadCommands(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                BallClear::class,
                MakeTable::class,
                MakeCrud::class,
            ]);
        }
    }

}
