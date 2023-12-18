<?php

namespace App\Console\Commands;

use App\Mail\SendReminderMail;
use App\Models\Reminder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendReminderToEmailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-reminder-to-email-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminder when remind_at active';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $reminders = Reminder::where([
            ['remind_at', '>=', now()->timestamp],
            ['sent_email', false],
        ])->get();

        foreach ($reminders as $reminder) {
            Mail::to($reminder->user)->send(new SendReminderMail($reminder));

            $reminder->update([
                'sent_email' => true,
            ]);
        }

    }
}
