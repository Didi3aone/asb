<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnMasterTheme extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('master_themes', function (Blueprint $table) {
            $table->dropColumn('code');
            $table->renameColumn('numbers', 'status');
            $table->string('file', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('master_themes', function (Blueprint $table) {
            //
        });
    }
}
