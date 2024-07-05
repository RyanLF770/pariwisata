<?php

// app/Notifications/BookingConfirmation.php
namespace App\Notifications;

use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookingConfirmation extends Notification
{
    use Queueable;

    protected $transaction;

    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Booking Confirmation')
            ->line('A new booking has been made.')
            ->line('Booking ID: ' . $this->transaction->booking->id)
            ->line('Destination: ' . $this->transaction->booking->destination->title)
            ->line('Quantity: ' . $this->transaction->booking->quantity)
            ->line('Total Amount: Rp. ' . $this->transaction->amount)
            ->line('Payment Method: ' . $this->transaction->payment_method)
            ->line('Payment Details: ' . $this->transaction->payment_details)
            ->line('Thank you for using our application!');
    }
}
