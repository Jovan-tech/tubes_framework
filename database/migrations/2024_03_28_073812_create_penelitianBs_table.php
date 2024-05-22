<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenelitianBsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penelitianB', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_penelitianB',6)->unique();
            $table->string('bahan_penelitian',50);
            $table->string('transkrip_pengujian',100);
            $table->string('inventaris',100);
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
        Schema::dropIfExists('penelitianB');
    }
}
