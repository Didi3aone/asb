<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStokBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stok_barang', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('gudang_id')->nullable();
            $table->integer('barang_id')->nullable();
            $table->bigInteger('stock')->nullable();
            $table->timestamps();
        });

        Schema::create('log_stok_barang', function (Blueprint $table) {
            $table->string('id');
            $table->primary('id');
            $table->bigInteger('stock_barang_id');
            $table->integer('log_type')->default(1);
            $table->bigInteger('qty_before')->default(0);
            $table->bigInteger('qty_after')->default(0);
            $table->timestamps();
            $table->integer('created_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stok_barang');
    }
}
