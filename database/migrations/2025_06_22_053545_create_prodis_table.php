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
    Schema::create('prodis', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->unsignedBigInteger('fakultas_id');
        $table->timestamps();

        $table->foreign('fakultas_id')->references('id')->on('fakultas')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prodis');
    }
};
