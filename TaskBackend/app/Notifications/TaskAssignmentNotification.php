<?php

namespace App\Notifications;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskAssignmentNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $task;
    protected bool $isTeamLead;

    public function __construct(Task $task, bool $isTeamLead = false)
    {
        $this->task = $task;
        $this->isTeamLead = $isTeamLead;
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        $message = (new MailMessage)
            ->subject('New Task Assignment')
            ->line('A new task has been assigned to you:')
            ->line('Title: ' . $this->task->title)
            ->line('Description: ' . $this->task->description)
            ->action('View Task', url('/tasks/' . $this->task->id));

        if ($this->isTeamLead) {
            $message->line('As the team lead, please oversee the completion of this task.');
        }

        return $message;
    }
}
