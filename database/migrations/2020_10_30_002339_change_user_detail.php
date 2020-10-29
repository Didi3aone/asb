<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeUserDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detail_users', function (Blueprint $table) {
            $table->string('kelurahan', 100)->change();
            $table->string('kelurahan_domisili', 100)->change();
            $table->string('avatar', 100)->default('noimage.jpg');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detail_users', function (Blueprint $table) {
            //
        });
    }
}
