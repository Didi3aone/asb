<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionStockDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_stok_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('transaksi_id');
            $table->string('nomor_sparepart');
            $table->bigInteger('barang_id');
            $table->bigInteger('qty');
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
        Schema::dropIfExists('transaction_stock_details');
    }
}
