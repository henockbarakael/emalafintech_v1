<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonnalInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personnal_informations', function (Blueprint $table) {
            $table->id();
            $table->string('card_type')->nullable();
            $table->string('card_id')->nullable();
            $table->string('card_exp_date')->nullable();
            $table->string('township')->nullable();
            $table->string('city')->nullable();
            $table->string('nationality')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('no_children')->nullable();
            $table->string('rec_id')->nullable();
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
        Schema::dropIfExists('personnal_informations');
    }
}
