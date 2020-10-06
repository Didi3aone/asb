<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama', 100);
            $table->string('nik', 100);
            $table->string('no_telp', 100);
            $table->string('no_hp', 100);
            $table->string('email', 100);
            $table->string('password', 100);
            $table->string('alamat', 100);
            $table->integer('kelurahan');
            $table->integer('kecamatan');
            $table->integer('kabupaten');
            $table->integer('provinsi');
            $table->integer('gender');
            $table->string('foto_ktp', 100);
            $table->string('foto_kk', 100);
            $table->integer('status_kawin');
            $table->integer('agama');
            $table->integer('pekerjaan');
            $table->integer('status_korlap');
            $table->smallInteger('is_active')->default(1);
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
        Schema::dropIfExists('members');
    }
}
