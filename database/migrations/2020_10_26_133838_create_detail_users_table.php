<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('userid');
            $table->string('no_member', 100);
            $table->string('nickname', 100);
            $table->string('nik', 100);
            $table->string('no_kk', 100);
            $table->string('email', 100);
            $table->string('password', 100);
            $table->integer('gender');
            $table->string('birth_place');
            $table->date('tgl_lahir');
            $table->integer('status_kawin');
            $table->integer('pekerjaan');
            $table->string('no_hp', 100);
            $table->text('alamat');
            $table->integer('kelurahan');
            $table->integer('kecamatan');
            $table->string('kabupaten');
            $table->integer('provinsi');
            $table->text('alamat_domisili');
            $table->integer('kelurahan_domisili');
            $table->integer('kecamatan_domisili');
            $table->string('kabupaten_domisili');
            $table->integer('provinsi_domisili');
            $table->string('foto_ktp', 100)->nullable();
            $table->string('foto_kk', 100)->nullable();
            $table->integer('status_korlap');
            $table->string('activation_code', 100);
            $table->tinyInteger('is_verify')->default(0);
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('detail_users');
    }
}
