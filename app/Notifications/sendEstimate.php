<?php

namespace App\Notifications;

use Barryvdh\DomPDF\Facade;
use http\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class sendEstimate extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @param $client
     */
    public function __construct($estimate, $color)
    {
        $this->estimate = $estimate;
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
        $estimate = $this->estimate;
        $pdf = Facade::loadView('estimates.pdf', compact('estimate'));




        return (new MailMessage)
            ->markdown(
                'vendor.notifications.estimate' , ['estimate' => $this->estimate, 'color' => $this->color]
            )
            ->attachData($pdf->output(), 'estimate '.$estimate->number.'.pdf');
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
