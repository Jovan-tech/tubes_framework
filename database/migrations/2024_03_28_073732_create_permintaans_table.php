<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermintaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permintaan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_permintaan',6)->unique();
            $table->string('nama_permintaan',50);
            $table->string('nama_pengajuan',100);
            $table->dateTime('tanggal_pengajuan');
            $table->string('tipe_pengajuan',100);
            $table->string('note',100);
            $table->integer('jumlah_pengajuan');
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
        Schema::dropIfExists('permintaan');
    }
}
