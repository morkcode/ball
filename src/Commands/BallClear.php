<?php

namespace morkcode\Ball\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class BallClear extends Command
{
    protected $signature = 'ball:clear';
    protected $description = 'Clear & Optimize all Application.';

    public function handle()
    {

        if ($this->confirm('Do you wish to continue?', true )) {

            $messages = '';

            // debugbar:clear
            Artisan::call('debugbar:clear');
            $messages .= Artisan::output();

            Artisan::call('cache:clear');
            $messages .= Artisan::output();

            Artisan::call('route:clear');
            $messages .= Artisan::output();

            Artisan::call('view:clear');
            $messages .= Artisan::output();

            Artisan::call('event:clear');
            $messages .= Artisan::output();

            Artisan::call('config:clear');
            $messages .= Artisan::output();

            Artisan::call('view:cache');
            $messages .= Artisan::output();

            Artisan::call('event:cache');
            $messages .= Artisan::output();

            Artisan::call('config:cache');
            $messages .= Artisan::output();

            $this->info( $messages );

            // $this->info( '=========================' );
            $result = glob(base_path() . '/storage/logs/*.log');
            if(count($result)) {
                // log files exist
                $this->info(count($result));
                exec('rm -f ' . base_path() . '/storage/logs/*.log');
                $this->info( 'Deleted log files' );
            }
            // $this->info( '=========================' );

            $this->info('Done...!!!');
        }
    }
}
