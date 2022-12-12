<?php

namespace App\Http\Controllers\Api\AdminAndUser;

use App\Http\Controllers\Controller;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Api\User\WeightController;
use Carbon\Carbon;
use App\Models\ExeciseReminder;
use App\Models\User;


class AuthController extends Controller
{
    use GeneralTrait;


public function login(Request $request){

    try {
        $rules = [
            'email' => 'required',
            'password' => 'required'
        ];

        $validator = Validator::make($request -> all(),$rules);
        if($validator->fails()){
            $code = $this->returnCodeAccordingToInput($validator);
            return  $code;
            return $this->returnValidationError($code,$validator);
        }
        //login
        $credentials = $request -> only(['email','password']);
        $token = Auth::guard('user-api') -> attempt($credentials);

        if(!$token)
            return null;
            //return Token
            $user = Auth::guard('user-api')->user();
            $user -> api_Token = $token;
        return $user;
    } catch (\Exception $ex) {
        return $this -> returnError($ex -> getCode(),$ex -> getMessage());
    }
}





    public function loginUser(Request $request){
        $user = $this->login($request);
        if($user){
            if($user->level  === 0)
            {
                $user_coll =  collect($user);
                if($user -> first_name != null){
                    $weight = (new WeightController) -> getCurrentWeightUser($user -> id);
                    $user_coll->put('weight', $weight);
                }

                return  $this->returnData("User",$user_coll);
            }else{
                return $this->returnError('E000','You must be an user.');
            }
        }else{
            return  $this->returnError('E001','بيانات الدخول غير صحيحة');
        }
    }

    public function loginAdmin(Request $request){
        $user = $this->login($request);
        if($user){
            if($user->level  === 1)
            {
                return  $this->returnData("User",$user);
            }else{
                return $this->returnError('E000','You must be an admin.');
            }
        }else{
          return  $this->returnError('E001','بيانات الدخول غير صحيحة');
        }
    }

    public function logout(Request $request){
        $token = $request -> header('auth-token');
        if($token){
            try {
                JWTAuth::setToken($token)->invalidate();
            } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
                return $this -> returnError('E000','some thing went wrongs');
            }

            return $this -> returnSuccessMessage('Logged out successfully');
        }else{
            return $this -> returnError('E000','some thing went wrongs');
        }
    }


    public function test (){
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
        return  $FcmToken;
    }
}
