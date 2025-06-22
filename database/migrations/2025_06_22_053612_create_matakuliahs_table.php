<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('matakuliahs', function (Blueprint $table) {
        $table->id();
        $table->string('kode')->unique();
        $table->string('nama');
        $table->integer('sks');
        $table->unsignedBigInteger('prodi_id');
        $table->timestamps();

        $table->foreign('prodi_id')->references('id')->on('prodis')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matakuliahs');
    }
};
