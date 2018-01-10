<?php

namespace App\Console\Commands;

use App\Services\IncomeService;
use Illuminate\Console\Command;
use DateTime;

class DepositsIncome extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deposits:income {date?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    /**
     * @var IncomeService
     */
    private $service;

    /**
     * Create a new command instance.
     * DepositsIncome constructor.
     *
     * @param IncomeService $service
     */
    public function __construct(IncomeService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $date = $this->argument('date');

        if (empty($date)) {
            $date = new DateTime();
        } else {
            $date = DateTime::createFromFormat('Y-m-d', $date);
        }

        $this->info("Start income for {$date->format($date->format('d-m-Y'))}!");

        $this->service->byDate($date)->addIncome();

        $this->info("Count deposits {$this->service->countDeposit()} add income!");
    }
}
