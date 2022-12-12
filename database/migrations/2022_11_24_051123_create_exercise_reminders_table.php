<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExerciseRemindersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exercise_reminders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->integer('first_day')->nullable($value = true);;
            $table->integer('second_day')->nullable($value = true);;
            $table->integer('third_day')->nullable($value = true);;
            $table->integer('fourth_day')->nullable($value = true);;
            $table->integer('fifth_day')->nullable($value = true);;
            $table->timestamp('created_at')->useCurrent()->nullable($value = true);;
            $table->timestamp('updated_at')->useCurrent()->nullable($value = true);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exercise_reminders');
    }
}
