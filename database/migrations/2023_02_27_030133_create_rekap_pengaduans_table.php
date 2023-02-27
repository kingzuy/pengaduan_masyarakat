<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekap_pengaduans', function (Blueprint $table) {
            $table->id();
            $table->string('pengadu');
            $table->string('username_pengadu');
            $table->string('laporan');
            $table->string('petugas')->default('-');
            $table->string('username_petugas')->default('-');
            $table->string('status')->default('Pending');
            $table->string('pesan');
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
        Schema::dropIfExists('rekap_pengaduans');
    }
};
