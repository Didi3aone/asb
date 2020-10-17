<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnDeletedAt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('requests', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('r_detail_requests', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('purchase_orders', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('periode_programs', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('p_detail_periode_programs', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('requests', function (Blueprint $table) {
            //
        });
    }
}
