<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusProvince extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('provinsis', function (Blueprint $table) {
            $table->tinyInteger('status')->default(1);
        });
        Schema::table('kabupatens', function (Blueprint $table) {
            $table->renameColumn('is_active', 'status');
        });
        Schema::table('kecamatans', function (Blueprint $table) {
            $table->renameColumn('is_active', 'status');
        });
        Schema::table('kelurahans', function (Blueprint $table) {
            $table->renameColumn('is_active', 'status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('provinsis', function (Blueprint $table) {
            //
        });
    }
}
