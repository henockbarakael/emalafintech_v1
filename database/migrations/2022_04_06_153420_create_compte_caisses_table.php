<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompteCaissesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compte_caisses', function (Blueprint $table) {
            $table->id();
            $table->string('compte_id')->nullable()->comment('Numéro de compte de la caisse');
            $table->string('a_fullname')->nullable()->comment('Nom complet du caissier');
            $table->string('a_phone')->nullable()->comment('Numéro de téléphone du caissier');
            $table->string('a_email')->nullable()->comment('Adresse email du caissier');
            $table->double('debit')->nullable()->comment('Solde debit');
            $table->double('credit')->nullable()->comment('Solde credit');
            $table->double('solde')->nullable()->comment('Solde compte');
            $table->string('currency')->nullable()->comment('Devise');
            $table->string('agence_id')->nullable()->comment('Identifiant de l\'agence');
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
        Schema::dropIfExists('compte_caisses');
    }
}
