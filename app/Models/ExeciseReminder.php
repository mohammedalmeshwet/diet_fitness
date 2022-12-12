<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExeciseReminder extends Model
{
    protected $table="exercise_reminders";
    protected $fillable=[
        "active",
        "first_day",
        "second_day",
        "third_day",
        "fourth_day",
        "fifth_day"
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    use HasFactory;

    // public function user(){
    //     return $this->belongsTo(User::class,'user_id');
    // }
}
