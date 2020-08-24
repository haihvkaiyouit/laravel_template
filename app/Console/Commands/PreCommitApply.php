<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PreCommitApply extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'precommit:apply';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'pre-commit script';

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
        echo shell_exec('cp supports/pre-commit .git/hooks/pre-commit');
        echo shell_exec('chmod +x .git/hooks/pre-commit');
    }
}
