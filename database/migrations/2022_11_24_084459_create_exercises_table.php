<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExercisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exercises', function (Blueprint $table) {
            $table->id();
            $table->string('exercise_name')->nullable($value = true);;
            $table->string('video_path')->nullable($value = true);;
            $table->string('exercise_image')->nullable($value = true);;
            $table->string('muscle_image')->nullable($value = true);;
            $table->text('description')->nullable($value = true);;
            $table->string('count')->nullable($value = true);;
            $table->float('time')->nullable($value = true);;
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exercises');
    }
}
