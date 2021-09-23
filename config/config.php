<?php

return [

   /*
    |--------------------------------------------------------------------------
    | Application
    |--------------------------------------------------------------------------
    | dashboard     = 'DashBoard'          Url to show into DashBoard
    | logingoto     = 'home' or 'board'    When you login redirect to Home or Dashboard
    | logoutgoto    = 'home' or 'board'    When you logout redirect to Home or Dashboard
    |
    */
    'dashboard'     => env('BALL_DASHBOARD',    'DashBoard'),
    'logingoto'     => env('BALL_LOGINGOTO',    'board'),
    'logoutgoto'    => env('BALL_LOGOUTGOTO',   'home'),

    /** Enable or Disable access */
    'auth' => [
        'register'  => true,
        'verify'    => true,
        'reset'     => true,
        'confirm'   => true,
        'twofactor' => false,   // PatchBALL
    ],

    /*
    |--------------------------------------------------------------------------
    | Design
    |--------------------------------------------------------------------------*/
    'dsg' => [
        'auth_body_class'   => 'auth-gradient-shadow',
        'adm_body_class'    => 'layout-fixed layout-navbar-fixed sidebar-mini control-sidebar-push accent-primary',
        'color'             => 'primary',   // primary color

    ],
    /*
    |--------------------------------------------------------------------------
    | Layouts
    |--------------------------------------------------------------------------*/
    'layout' => [

        'robots'    => true,        // Exclude all robots
        'favicons'  => false,       // Show full favicons

        // TopNav
        'top_seach'     => true,   //
        'fullscreen'    => false,   //
        'user_name'     => false,   // User Name in Top Menu

        // Sidebar
        'sidebar_right' => true,    // Right Control Sidebar

    ],

    'table' => [
        'pagination' => 'ball::pagination.bs46-icons', // bs46-icons, bs46-simple, simple-bootstrap, bootstrap
        // 'pagination' => 'ball::pagination.bs46-simple',
        'records' => 25,
        'show_current_page' => true,
        // ???
        'records' => 25,
        // @todo
        'searchMinCharacters' => 3,
    ],

    /*
    |--------------------------------------------------------------------------
    | Icons - Font Awesome = /vendor/ball/componets/widget/icon.blade.php
    |--------------------------------------------------------------------------*/
    'icons' => [
        'save'      => 'far fa-save',
        'create'    => 'fas fa-plus',
        'delete'    => 'far fa-trash-alt',
        'erase'     => 'fas fa-trash-alt',
        'show'      => 'far fa-eye',
        'edit'      => 'far fa-edit',
        'restore'   => 'fas fa-trash-restore-alt',
        'back'      => 'fas fa-angle-double-left',
        'list-ol'   => 'fas fa-list-ol',
        'list'      => 'far fa-list-alt',           // tables
        'search'    => 'fas fa-search',

        'search'    => 'fas fa-search',
        'reset'     => 'fas fa-times-circle',

        'user'      => 'far fa-user-circle',
        'users'     => 'fas fa-user-friends',

        // card-tools
        'maximize'  => 'fas fa-expand',
        'expanded'  => 'fas fa-plus',
        'collapse'  => 'fas fa-minus',
        'remove'    => 'fas fa-times',
        // sorts
    ],

    /*
    |--------------------------------------------------------------------------
    | Alerts & Confirm
    | https://sweetalert2.github.io/#configuration
    |--------------------------------------------------------------------------*/

    'alert' => [
        'position' => 'top-end',
        'timer' => 3000,
        'toast' => true,
        'text' => null,
        'showCancelButton' => false,
        'showConfirmButton' => false
    ],
    'confirm' => [
        'icon' => 'warning',
        'position' => 'center',
        'toast' => false,
        'timer' => null,
        'showConfirmButton' => true,
        'showCancelButton' => true,
        'cancelButtonText' => 'No',
        'confirmButtonColor' => '#3085d6',
        'cancelButtonColor' => '#d33'
    ],

    /*
    |--------------------------------------------------------------------------
    | Paths
    |--------------------------------------------------------------------------*/
    'paths' => [
        'css'       => 'global/css/',
        'favicons'  => 'global/favicons/',
        'fonts'     => 'global/fonts/',
        /** Images */
        'img'       => 'global/img/',

        'js'        => 'global/js/',
        'plugins'   => 'global/plugins/',

        /** CSS de 3eros /vendor /lbs */
        'css3eros'  => 'global/libs/',
        /** Imagenes de 3eros /vendor Dir */
        'img3ros'   => 'global/img/vendor/',
    ],

    'dev' => [
        'pack' => 'Ball',
        'name' => 'morkCode',
        'description' => 'BALL - Bootstrap Alpine Laravel & Livewire library',
        'keywords' => 'bootstrap, alpine, laravel, livewire, dashboard',
        'url' => 'http://www.rednet.com.ar',
        'email' => 'jorge@constenla.com.ar',
        'version' => '0.1',
        'themecolor' => '#1269db',
        'mailer'    => 'BALL Mailer 1.0', // Cabecera de Mails
    ]
];
