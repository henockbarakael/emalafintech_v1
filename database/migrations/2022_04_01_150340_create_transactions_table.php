<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('sender_fullname')->nullable();
            $table->string('sender_phone')->nullable();
            $table->string('sender_birthday')->nullable();
            $table->string('sender_country')->nullable();
            $table->string('sender_address')->nullable();
            $table->string('sender_card')->nullable();
            $table->string('sender_card_id')->nullable();
            $table->double('amount')->nullable();
            $table->string('currency')->nullable();
            $table->string('transaction_type')->nullable();
            $table->string('operator')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('status')->nullable();
            $table->string('receiver_fullname')->nullable();
            $table->string('receiver_phone')->nullable();
            $table->string('receiver_city')->nullable();
            $table->string('receiver_country')->nullable();
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
        Schema::dropIfExists('transactions');
    }
}
