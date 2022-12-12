<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable($value = true);
            $table->string('last_name')->nullable($value = true);
            $table->string('email')->nullable($value = true);
            $table->string('password')->nullable($value = true);
            $table->date('birth_date')->nullable($value = true);
            $table->string('gender')->nullable($value = true);
            $table->integer('height')->nullable($value = true);
            $table->integer('level')->default(0)->comment('1->Admin,0->User');
            $table->string('device_key')->nullable($value = true);
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
        Schema::dropIfExists('users');
    }
}
