<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('article_categories', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->tinyInteger('is_active')->default(1);
        });
        Schema::table('information', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->tinyInteger('is_active')->default(1);
        });
        Schema::dropIfExists('categories');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('article_categories', function (Blueprint $table) {
            //
        });
    }
}
