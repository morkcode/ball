<?php

namespace morkcode\Ball\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeTable extends Command
{
    protected $signature = 'ball:make-table {name} {--model=Model} {--force}';
    protected $description = 'Create a new DataTable - Livewire component.';

    public function handle()
    {

    }


}
