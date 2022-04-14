<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmergencyInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emergency_informations', function (Blueprint $table) {
            $table->id();
            $table->string('emergency_fullname1')->nullable();
            $table->string('emergency_fullname2')->nullable();
            $table->string('emergency_phone1')->nullable();
            $table->string('emergency_phone2')->nullable();
            $table->string('relationship1')->nullable();
            $table->string('relationship2')->nullable();
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
        Schema::dropIfExists('emergency_informations');
    }
}
