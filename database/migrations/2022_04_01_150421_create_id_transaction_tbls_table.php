<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateIdTransactionTblsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE TRIGGER id_transaction BEFORE INSERT ON transactions FOR EACH ROW
            BEGIN
                INSERT INTO id_transaction_tbls VALUES (NULL);
                SET NEW.transaction_id = CONCAT("emala_", LPAD(LAST_INSERT_ID(), 10, "0"));
            END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       DB::unprepared('DROP TRIGGER "id_transaction"');
    }
}
