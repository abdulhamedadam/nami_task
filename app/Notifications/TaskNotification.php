<?php

namespace App\Notifications;

use App\Models\Admin\SubTask_M;
use App\Models\Admin\Task_M;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskNotification extends Notification
{
    use Queueable;


    protected $subTasks;

    /**
     * Create a new notification instance.
     */
    public function __construct($subTasks)
    {
        $this->subTasks = $subTasks;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {

        return [
            'type'                 => 'sub_task_start',
            'title'                => 'بدء المهمة ',
            'messages'             => $this->subTasks->sub_task_name.'هذه المهمة بدأت الان ',
            'main_task_id'         => $this->subTasks->id,
            'main_task_name'       => $this->subTasks->name,
            'sub_task_name'        => $this->subTasks->sub_task_name,
            'date'                 => $this->subTasks->date,
            'time'                 => $this->subTasks->time,
            'status'               => $this->subTasks->status,
        ];
    }
}
