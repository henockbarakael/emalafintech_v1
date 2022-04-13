<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMomoTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('momo_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('customer_number')->nullable();
            $table->decimal('amount',8,2)->nullable();
            $table->string('currency')->nullable();
            $table->string('comment')->nullable();
            $table->string('action')->nullable();
            $table->string('method')->nullable();
            $table->string('status')->nullable();
            $table->string('reference')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('final_status')->default('pending');
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
        Schema::dropIfExists('momo_transactions');
    }
}
