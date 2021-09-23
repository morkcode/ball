<?php

namespace morkcode\Ball\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeCrud extends Command
{
    protected $signature = 'ball:make-crud {name} {--model=Model} {--force}';
    protected $description = 'Create a new DataTable & Form - Livewire component.';

    public function handle()
    {

    }


}
