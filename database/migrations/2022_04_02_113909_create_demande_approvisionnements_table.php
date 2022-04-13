<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandeApprovisionnementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demande_approvisionnements', function (Blueprint $table) {
            $table->id();
            $table->string('sender_fullname')->nullable();
            $table->string('sender_number')->nullable();
            $table->string('sender_email')->nullable();
            $table->string('sender_motif')->nullable();
            $table->string('sender_amount')->nullable();
            $table->string('code_agent')->nullable();
            $table->string('receiver_code')->nullable();
            $table->string('status')->default('En cours');
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
        Schema::dropIfExists('demande_approvisionnements');
    }
}
