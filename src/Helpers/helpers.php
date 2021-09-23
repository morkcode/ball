<?php

/**
 * Lavavel Lib included
 */
use Illuminate\Support\Arr;
use Illuminate\Support\Str;



/**
 * return true or false
 */
 if (!function_exists('is_true')) {
    function is_true( $var ): bool
    {
        if( isset( $var  ) && $var === false ) {
            return false;
        }
        return true;
    }
}
/** Alias is_true() */
if (!function_exists('is_searchable')) {
    function is_searchable( $var  ): bool
    {
        return is_true( $var );
    }
}
/** Alias is_true() */
if (!function_exists('is_sortable')) {
    function is_sortable( $var  ): bool
    {
        return is_true( $var );
    }
}
/** Alias is_true() */
if (!function_exists('is_visible')) {
    function is_visible( $var  ): bool
    {
        return is_true( $var );
    }
}
