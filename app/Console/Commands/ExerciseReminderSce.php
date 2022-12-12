<?php

namespace App\Console\Commands;

use App\Models\ExeciseReminder;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\User;
use App\Http\Controllers\Api\User\NotificationController;
class ExerciseReminderSce extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exercise:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'exercise Reminder by time is privet for each user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {
        $dayOfTheWeek = Carbon::now()->dayOfWeek;
        $user_exercise_reminders =  ExeciseReminder::where("first_day", $dayOfTheWeek)
                                ->orWhere("second_day", $dayOfTheWeek)
                                ->orwhere("third_day",$dayOfTheWeek)
                                ->orwhere("fourth_day",$dayOfTheWeek)
                                ->orwhere("fifth_day",$dayOfTheWeek)
                                ->get();
        $FcmToken = collect();

        foreach ($user_exercise_reminders as $exercise_reminder) {
            $FcmToken -> push(User::find($exercise_reminder -> user_id) -> device_key);
        }
        
        $title = 'تذكير';
        $body = 'لديك تمرين اليوم';
        (new NotificationController) -> sendNotification($FcmToken->all(), $title, $body);
    }
}
