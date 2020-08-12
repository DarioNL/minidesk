<?php

namespace App\Notifications;

use Barryvdh\DomPDF\Facade;
use http\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class paymentReceived extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @param $client
     */
    public function __construct($invoice, $color)
    {
        $this->invoice = $invoice;
        $this->color = $color;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $invoice = $this->invoice;
        $pdf = Facade::loadView('invoices.pdf', compact('invoice'));

        return (new MailMessage)
            ->markdown(
                'vendor.notifications.paymentReceived' , ['invoice' => $this->invoice, 'color' => $this->color]
            )
            ->attachData($pdf->output(), 'invoice '.$invoice->number.'.pdf');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
