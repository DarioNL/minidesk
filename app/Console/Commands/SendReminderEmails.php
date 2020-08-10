<?php

namespace App\Console\Commands;

use App\Models\Estimate;
use App\Models\Invoice;
use App\Notifications\sendInvoice;
use App\Notifications\sendEstimate;
use Carbon\Carbon;
use Faker\Provider\DateTime;
use Illuminate\Console\Command;
use Mollie\Laravel\Facades\Mollie;

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
     * @return void
     */
    public function handle()
    {


        $estimates = Estimate::all()->where('send_date', '=', Date('Y-m-d'). ' 00:00:00');

        foreach ($estimates as $estimate){
            $estimate->client->notify(new sendEstimate($estimate, $estimate->color));
        }

        $invoices = Invoice::all()->where('send_date', '=', date('Y-m-d').' 00:00:00');

        foreach ($invoices as $invoice){
            $description = $invoice->number;
            if ($invoice->title != null) {
                $description = $invoice->title;
            }
            $invoice->number = '#FAC' . random_int(0, 9) . random_int(0, 9) . random_int(0, 9) . random_int(0, 9);
            $invoice->save();

            Mollie::api()->setApiKey($invoice->company->mollie_key);
            $payment = Mollie::api()->payments()->create([
                'amount' => [
                    'currency' => 'EUR',
                    'value' => $invoice->total,
                ],
                'description' => 'Invoice  ' . $description,
                'webhookUrl' => 'https://webhook.site/ee4f2604-574a-479a-a678-cd8a4ee919f6',
                'redirectUrl' => 'http://localhost:8000/company/invoices',
                'method' => 'creditcard',
                'metadata' => array(
                    'order_id' => $invoice->number
                )
            ]);


            if ($payment) {
                $invoice->pay_id = $payment->_links->checkout->href;
                $invoice->save();
                $invoice->client->notify(new sendInvoice($invoice, $invoice->color));
            } else {
                $invoice->number = null;
                $invoice->save();
                dd('Creating mollie payment failed.');
            }

        }
    }
}
