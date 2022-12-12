<?php

namespace App\Http\Controllers\Api\Exercise;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use App\Models\Exercise;
use App\Traits\ExerciseTrait;

class ExerciseController extends Controller
{
    use GeneralTrait;
    use ExerciseTrait;

    public function addExercise(Request $request){
        // $video_path  =  $request -> file('video_exercise') -> store('Exercise\video');
        // $exercise_image_path =  $request -> file('exercise_image') -> store('Exercise\Image');
        // $muscle_image_path = $request -> file('muscle_image') -> store('Exercise\muscleImage');

        $exercise_photo_path = $this -> saveImage($request -> photo_exercise , 'Exercise/Image');
        $muscle_photo_path = $this -> saveImage($request -> photo_muscle , 'Exercise/muscleImage');
        $exercise  = new Exercise();
        $exercise -> exercise_name = $request -> exercise_name;
        $exercise -> video_path =  $request -> video_exercise;
        $exercise -> exercise_image = $exercise_photo_path;
        $exercise -> muscle_image = $muscle_photo_path;
        $exercise -> description = $request -> description;
        $exercise -> count = $request -> count;
        $exercise -> time = $request -> time;
        $exercise -> save();
        return $this->returnSuccessMessage('Exercise has been added sucessfully');
    }

    public function getAllExercises(){
        $exercises =  (new Exercise()) -> all() ;
        return $this->returnData('exercises', $exercises);
    }
}

