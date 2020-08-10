<?php

namespace App\Console\Commands;

use App\Models\Estimate;
use App\Models\Invoice;
use App\Notifications\sendEstimate;
use Carbon\Carbon;
use Faker\Provider\DateTime;
use Illuminate\Console\Command;

class SendReminderEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminders:emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email notification to user';

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
     * @return int
     */
    public function handle()
    {

        $estimates = Estimate::all()->where('send_date', '=', Date('Y-m-d'). ' 00:00:00');

        foreach ($estimates as $estimate){
            $estimate->client->notify(new sendEstimate($estimate, $estimate->color));
        }

        $invoices = Invoice::all()->where('send_date', '=', DateTime::date('Y-m-d'));

        foreach ($invoices as $invoice){
            $invoice->client->notify(new sendInvoice($invoice, $estimate->color));
        }
    }
}
