<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Models\MealReminder;
use Carbon\Carbon;
class MealReminderController extends Controller
{
    use GeneralTrait;

    public function SaveMealReminder (Request $request){
        $user = auth()->user();
        $meal_reminder = new MealReminder();
        $meal_reminder -> user_id = $user -> id;
        $meal_reminder -> first_meal_time = $request -> first_meal_time;
        $meal_reminder -> second_meal_time = $request -> second_meal_time;
        $meal_reminder -> third_meal_time = $request -> third_meal_time;
        $meal_reminder -> save();
        return $this -> returnSuccessMessage('تم حفظ المواعيد بنجاح');
    }
}

