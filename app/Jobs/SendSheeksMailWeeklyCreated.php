<?php

namespace App\Jobs;

use App\Mail\SendSheekWasWeeklyCreated;
use App\Models\Admin;
use App\Notifications\SendReminderUserMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class SendSheeksMailWeeklyCreated implements ShouldQueue
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
        $admins = Admin::whereHas('sheeks')->where('active', '=', true)->get();
        // foreach ($admins as $admin) {
        //     Mail::to($admin->email)->send(new SendSheekWasWeeklyCreated($admin));
        // }
        Notification::send($admins, new SendReminderUserMail());
    }
}