<?php

namespace App\Http\Controllers\Api\AdminAndUser;

use App\Http\Controllers\Controller;
use App\Models\Food;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    use GeneralTrait;
    public function getAllFoods(){
        $foods=Food::all();
        return $this -> returnData('foods',$foods);
    }

    // public function getAllFoods(){
    //     $foods=Food::all();
    //     $name_col = collect();
    //     foreach ($foods as $value) {
    //         $name_col -> push([$value -> id => $value -> food_name]);
    //     }
    //     return $this -> returnData('foods',$name_col);
    // }

    public function store(Request $request){
            $food= new Food;
            $food->food_name = $request->food_name;
            $food->save();
        return  $this->returnSuccessMessage("food name has been added sucessfully");

    }
}
