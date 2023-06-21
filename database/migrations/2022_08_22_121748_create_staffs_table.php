<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staffs', function (Blueprint $table) {
            $table->id();
            $table->string('secure_token');
            $table->string('name')->nullable();
            $table->string('username')->nullable();
            $table->string('phone_no')->nullable();
            $table->integer('user_status')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('password');
            $table->string('user_level')->nullable();
            $table->dateTime('last_login')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staffs');
    }
}
