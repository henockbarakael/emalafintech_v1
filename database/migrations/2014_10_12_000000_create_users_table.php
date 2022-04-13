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
            $table->integer('points');
            $table->string('name');
            $table->string('firtsname');
            $table->string('rec_id');
            $table->string('email')->unique();
            $table->string('join_date')->unique()->nullable();
            $table->string('telephone')->nullable();
            $table->string('status')->nullable();
            $table->string('role_name')->nullable();
            $table->string('avatar')->default('avatar.png');
            $table->string('ville')->nullable();
            $table->string('sexe')->nullable();
            $table->text('adresse')->nullable();
            $table->string('carte')->nullable();
            $table->integer('id_carte')->nullable();
            $table->tinyInteger('is_verified')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
