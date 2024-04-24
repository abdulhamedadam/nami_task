<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskNotFinishedNotification extends Notification
{
    use Queueable;

    public function __construct($Tasks)
    {
        $this->Tasks = $Tasks;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {

        return [
            'type'             => 'unfinished_tasks',
            'main_task_name'   =>  $this->Tasks->name,
            'main_task_id'     =>  $this->Tasks->name,
            'sub_task_name'    => '',
            'date'             => '',
            'time'             => '',
            'status'           => '',
        ];
    }
}
