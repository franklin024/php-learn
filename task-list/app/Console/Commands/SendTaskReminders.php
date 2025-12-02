<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\TaskReminderMail;


class SendTaskReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-task-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gửi email nhắc nhở cho các user còn task chưa xong';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::whereHas('tasks', function ($query) {
            $query->where('completed', false);
        })->with(['tasks' => function ($query) {
            $query->where('completed', false);
        }])->get();

        // 2. Duyệt qua từng user và gửi mail
        foreach ($users as $user) {
            // Kiểm tra lại lần nữa cho chắc
            if ($user->tasks->count() > 0) {

                Mail::to($user->email)->send(
                    new TaskReminderMail($user, $user->tasks)
                );

                $this->info("Đã gửi nhắc nhở cho: {$user->email}");
            }
        }

        $this->info('Hoàn tất gửi email nhắc nhở!');
    }
}
