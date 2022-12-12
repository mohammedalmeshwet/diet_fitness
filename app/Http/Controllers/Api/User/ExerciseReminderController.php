<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Models\ExeciseReminder;
use Carbon\Carbon;
class ExerciseReminderController extends Controller
{
    use GeneralTrait;

    public function SaveExerciseReminder (Request $request){
        
        $user = auth()->user();
        $exercise_reminder = new ExeciseReminder();
        $exercise_reminder -> user_id = $user -> id;
        $exercise_reminder -> first_day = $request -> exercise_days[0];
        $exercise_reminder -> second_day = $request -> exercise_days[1];
        $exercise_reminder -> third_day = $request -> exercise_days[2];
        if( count($request -> exercise_days) >= 4){
            $exercise_reminder -> fourth_day = $request -> exercise_days[3];
        }
        if( count($request -> exercise_days) == 5){
            $exercise_reminder -> fifth_day = $request -> exercise_days[4];
        }
        $exercise_reminder -> save();
        return $this -> returnSuccessMessage('تم حفظ أيام لعب التمارين بنجاح');
    }
}

