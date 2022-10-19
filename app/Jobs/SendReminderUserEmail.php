<?php

namespace App\Jobs;

use App\Mail\AdminWelcomeEmail;
use App\Mail\ReminderRegisterUser;
use App\Models\Admin;
use App\Notifications\SendReminderUserMail;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class SendReminderUserEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $admins = Admin::whereNull('email_verified_at')
            // ->whereDate('created_at', '<=', Carbon::now()->subDays(7))
            ->get();

        // foreach ($admins as $admin) {
        //     Mail::to($admin->email)->send(new ReminderRegisterUser($admin));
        // }
        Notification::send($admins, new SendReminderUserMail);
    }
}
