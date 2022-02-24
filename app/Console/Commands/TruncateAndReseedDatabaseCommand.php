<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class TruncateAndReseedDatabaseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:truncate-reseed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command truncates and reseeds the database everyday at midnight UTC';

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
     * @return void
     */
    public function handle() : void
    {
        $bar = $this->output->createProgressBar(2);
        $bar->start();

        for ($i = 0; $i < 2; $i++){
            $command = ($i === 0) ? 'migrate:fresh' : 'db:seed';
            $this->performTask($command);
            $bar->advance();
        }

        $bar->finish();
    }

    public function performTask($command) : void
    {
        Artisan::call($command);
    }
}
