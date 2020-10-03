<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTabelCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_customer', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->bigInteger('no_telp')->nullable();
            $table->bigInteger('no_hp')->nullable();
            $table->string('email')->nullable();
            $table->string('pic')->nullable();
            $table->bigInteger('no_rekening')->nullable();
            $table->integer('ppn')->default(0);
            $table->string('alamat')->nullable();
            $table->string('password')->nullable();
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
        Schema::dropIfExists('mst_customer');
    }
}
