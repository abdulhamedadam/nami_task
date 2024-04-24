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
            'type'                 => 'unfinished_tasks',
            'title'                => 'مهام لم تنتهي خلال اليومين ',
            'messages'             => $this->Tasks->name.'لم تنتهي خلال اليومين من انشائها ',
            'main_task_name'       =>  $this->Tasks->name,
            'main_task_id'         =>  $this->Tasks->id,
            'sub_task_name'        => '',
            'date'                 => '',
            'time'                 => '',
            'status'               => '',
        ];
    }
}
