<?php

namespace App\Console\Commands;

use App\Models\MealReminder;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\User;
use App\Http\Controllers\Api\User\NotificationController;
class MealReminderSce extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'meal:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Meal Reminder by time is privet for each user';

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
        $time_reminder = Carbon::now()->subMinutes(15)->format('H:i');
        $user_meal_reminders =  MealReminder::where("first_meal_time", $time_reminder)
                                ->orWhere("second_meal_time", $time_reminder)
                                ->orwhere("third_meal_time",$time_reminder)->get();
        $FcmToken = collect();

        foreach ($user_meal_reminders as $meal_reminder) {
            $FcmToken -> push(User::find($meal_reminder -> user_id) -> device_key);
        }
        $title = 'تذكير';
        $body = 'حان موعد تناول وجبة الطعام';
        (new NotificationController) -> sendNotification($FcmToken->all(), $title, $body);
    }
}
