<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unit_barang', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
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
        Schema::dropIfExists('unit_barang');
    }
}
