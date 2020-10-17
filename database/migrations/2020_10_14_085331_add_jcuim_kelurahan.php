<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddJcuimKelurahan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kelurahans', function (Blueprint $table) {
            $table->string('id_jcuim', 100)->nullable();
            $table->string('id_kemendag', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kelurahans', function (Blueprint $table) {
            $table->dropColumn('id_jcuim');
            $table->dropColumn('id_kemendag');
        });
    }
}
