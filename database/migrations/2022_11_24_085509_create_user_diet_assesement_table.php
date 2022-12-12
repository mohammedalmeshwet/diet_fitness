<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDietAssesementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_diet_assesement', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('goal_id')->nullable($value = true);;
            $table->unsignedBigInteger('user_id')->nullable($value = true);;
            $table->unsignedBigInteger('diet_id')->nullable($value = true);;
            $table->unsignedBigInteger('user_excercise_id')->nullable($value = true);;
            $table->integer('old_weight_value')->nullable($value = true);;
            $table->integer('new_weight_value')->nullable($value = true);;
            $table->integer('rank')->nullable($value = true);;
            $table->integer('is_pass')->coment('1->pass,0->fail');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->foreign('goal_id')->references('id')->on('goals')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('diet_id')->references('id')->on('diets')->onDelete('cascade');
            $table->foreign('user_excercise_id')->references('id')->on('user_exercise')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_diet_assesement');
    }
}
