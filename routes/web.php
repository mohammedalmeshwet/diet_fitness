<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //  return view('welcome');
//    echo asset('storage/app/Exercise/video/1.jpg');
return $path = $path = storage_path(). 'Exercise/video/A3lqbsb6qeca98IwABujX4zyoBBc2p5foUhm27NF.mp4';
    //  return $path = Storage::path('Exercise/video/A3lqbsb6qeca98IwABujX4zyoBBc2p5foUhm27NF.mp4');
    // return "diet Project";
    // echo asset('storage\app\Exercise\video\A3lqbsb6qeca98IwABujX4zyoBBc2p5foUhm27NF.mp4');
});
