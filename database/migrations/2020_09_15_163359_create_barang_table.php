<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('kategori_id');
            $table->integer('unit_id');
            $table->string('kode')->nullable();
            $table->string('nama')->nullable();
            $table->decimal('harga_beli', 16, 2)->nullable()->default(00.00);
            $table->decimal('harga_jual', 16, 2)->nullable()->default(00.00);
            $table->string('foto')->nullable();
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
        Schema::dropIfExists('barang');
    }
}
