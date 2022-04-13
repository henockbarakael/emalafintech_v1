<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoldeAgencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solde_agences', function (Blueprint $table) {
            $table->id();
            $table->double('cdf_a')->nullable();
            $table->double('usd_a')->nullable();
            $table->string('code_a')->nullable();
            $table->unsignedBigInteger('agence_id');
            $table->timestamps();
            $table->foreign('agence_id')->references('id')->on('agences');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solde_agences');
    }
}
