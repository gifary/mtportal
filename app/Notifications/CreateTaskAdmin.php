<?php

namespace App\Notifications;

use App\SupportTicket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CreateTaskAdmin extends Notification
{
    use Queueable;

    private $supportTicket;

    public function __construct(SupportTicket $supportTicket)
    {
        $this->supportTicket = $supportTicket;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $name = $this->supportTicket->user->name;
        $business_name ='';
        if(!empty($this->supportTicket->user->business)){
            $business_name = $this->supportTicket->user->business->cname;
        }

        return (new MailMessage)
                    ->line("A new ticket has been posted by [{$name}] from [{$business_name}]. Please check and do the needful.")
                    ->action('Vie Ticket', url('/'));
    }


    public function toDatabase($notifiable)
    {
        $name = $this->supportTicket->user->name;
        if(!empty($this->supportTicket->user->business)){
            $name = $this->supportTicket->user->business->cname;
        }
        return [
            'data'=> "A new ticket has been raised by [".$name."]"
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
