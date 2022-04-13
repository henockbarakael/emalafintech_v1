<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRetraitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retraits', function (Blueprint $table) {
            $table->id();
            $table->string('receiver_fullname')->nullable();
            $table->string('receiver_phone')->nullable();
            $table->string('sender_phone')->nullable();
            $table->double('amount')->nullable();
            $table->string('transaction_type')->nullable();
            $table->string('operator')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('details')->nullable();
            $table->string('agent_id')->nullable();
            $table->string('commission')->nullable();
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
        Schema::dropIfExists('retraits');
    }
}
