<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('do_id');
            $table->integer('custid');
            $table->date('send_date')->default('1900-01-01');
            $table->date('receive_date')->nullable();
            $table->tinyInteger('is_active')->default(1);
            $table->tinyInteger('status')->default(0);
            $table->integer('created_by');
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
        Schema::dropIfExists('delivery_logs');
    }
}
