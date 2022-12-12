<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealReminder extends Model
{
    protected $table="meal_reminder";
    protected $fillable=[
        "active",
        "first_meal_time",
        "second_meal_time",
        "third_meal_time"
    ];

    public $timestamps = false;

    use HasFactory;

    // public function user(){
    //     return $this->belongsTo(User::class,'user_id');
    // }
}
