<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainExerDayExercisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('train_exer_day_exercises', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('trainning_exercise_day_id');
            $table->unsignedBigInteger('exercise_id');
            $table->foreign('trainning_exercise_day_id')->references('id')->on('trainning_exercise_day')->onDelete('cascade');
            $table->foreign('exercise_id')->references('id')->on('exercises')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('train_exer_day_exercises');
    }
}
