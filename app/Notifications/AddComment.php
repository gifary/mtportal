<?php

namespace App\Notifications;

use App\TicketComment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AddComment extends Notification
{
    use Queueable;

    private $ticketComment;
    private $ticketNumber;

    public function __construct(TicketComment $ticketComment,$ticketNumber)
    {
        $this->ticketComment = $ticketComment;
        $this->ticketNumber =$ticketNumber;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line("You have a new comment for Ticket ".$this->ticketNumber."]!");
    }


    public function toDatabase($notifiable)
    {
        return [
            'data'=> "You have a new comment for Ticket ".$this->ticketNumber."!"
        ];
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
