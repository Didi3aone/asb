<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusPenerima extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('r_detail_requests', function (Blueprint $table) {
            $table->tinyInteger('status_penerima')->default(0);
            $table->dateTime('tanggal_terima')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('r_detail_requests', function (Blueprint $table) {
            //
        });
    }
}
