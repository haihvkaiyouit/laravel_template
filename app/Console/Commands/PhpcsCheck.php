<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PhpcsCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'phpcs:check {files?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'PHP coding standards check';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        echo shell_exec('vendor/bin/phpcs --standard=supports/phpcs/ruleset.xml ' . $this->argument('files'));
    }
}
