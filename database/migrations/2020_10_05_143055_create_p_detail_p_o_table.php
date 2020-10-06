<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePDetailPOTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_detail_po', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_barang');
            $table->string('nomor_po', 100)->nullable()->default('text');
            $table->integer('qty');
            $table->decimal('price', 15, 2)->nullable();
            $table->decimal('ppn', 15, 2)->nullable();
            $table->decimal('total', 15, 2)->nullable();
            $table->decimal('grand_total', 15, 2)->nullable();
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
        Schema::dropIfExists('p_detail_po');
    }
}
