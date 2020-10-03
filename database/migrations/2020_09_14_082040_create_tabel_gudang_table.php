<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTabelGudangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_gudang', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_gudang')->nullable();
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
        Schema::dropIfExists('tabel_gudang');
    }
}
