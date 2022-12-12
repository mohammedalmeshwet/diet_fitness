<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserMealsComplianceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_meals_compliance', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('meal_id')->nullable($value = true);
            $table->unsignedBigInteger('user_diet_id');
            $table->dateTime('planned_meal_date')->nullable($value = true);
            $table->integer('meal_status')->nullable($value = true);
            $table->string('note')->nullable($value = true);
            $table->dateTime('user_feedback_date')->nullable($value = true);
            $table->integer('commitement_percentage')->nullable($value = true);
            $table->foreign('meal_id')->references('id')->on('meals')->onDelete('cascade');
            $table->foreign('user_diet_id')->references('id')->on('user_diet')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_meals_compliance');
    }
}
