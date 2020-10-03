<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterLogStockBarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('log_stok_barang', function (Blueprint $table) {
            $table->integer('transaksi_id')->default(0);
        });

        Schema::table('barang', function (Blueprint $table) {
            $table->bigInteger('stok_akhir')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('log_stok_barang', function (Blueprint $table) {
            //
        });
    }
}
