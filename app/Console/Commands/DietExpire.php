<?php

namespace App\Console\Commands;

use App\Models\UserDiet;
use App\Models\User;
use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Http\Controllers\Api\User\NotificationController;
class DietExpire extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user_diet:active';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Diet user active after 20 days ';

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
        $user_diet_actives =  UserDiet::where('active',1) -> get();
        $FcmToken = collect();

        foreach ($user_diet_actives as $key => $user_diet)
        {
                $created = new Carbon($user_diet -> created_at);
                $now = Carbon::now();
                if ($created->diff($now)->days > 20)
                {
                    $user_diet -> active = 0;
                    $user_diet -> save();
                    $FcmToken -> push(User::find($user_diet -> user_id) -> device_key);

                }
        }
        $title = 'تذكير';
        $body = 'تم مرور 20 يوم على استخدام الدايت الحالي. يرجى الاطلاع ';
        (new NotificationController) -> sendNotification($FcmToken->all(), $title, $body);
    }
}
