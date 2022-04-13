<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaissesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caisses', function (Blueprint $table) {
            $table->id();
            $table->string('code_c')->nullable();
            $table->string('usd_c')->nullable();
            $table->string('cdf_c')->nullable();
            $table->unsignedBigInteger('gerant_id');
            $table->timestamps();
            $table->foreign('gerant_id')->references('id')->on('gerants');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('caisses');
    }
}
