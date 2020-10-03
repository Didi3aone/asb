<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_stoks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nomor_transaksi');
            $table->string('nomor_ijin')->nullable();
            $table->date('tanggal_transaksi')->nullable();
            $table->bigInteger('gudang_id');
            $table->integer('tipe')->defualt(1);
            $table->integer('is_active')->default(1);
            $table->timestamps();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->softDeletes();
            $table->integer('deleted_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_stocks');
    }
}
