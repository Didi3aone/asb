<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRDetailPurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('r_detail_purchases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_po', 100);
            $table->integer('is_active');
            $table->integer('id_barang');
            $table->integer('qty')->default(0);
            $table->decimal('price', 16, 2)->default(0.00);
            $table->integer('ppn')->default(0);
            $table->decimal('total', 16, 2)->default(0.00);
            $table->timestamp('deleted_at')->nullable();
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
        Schema::dropIfExists('detail_purchases');
    }
}
