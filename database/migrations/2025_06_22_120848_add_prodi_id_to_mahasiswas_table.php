<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up(): void
{
    Schema::table('mahasiswas', function (Blueprint $table) {
        $table->unsignedBigInteger('prodi_id')->nullable()->after('nama');
        $table->foreign('prodi_id')->references('id')->on('prodis')->onDelete('set null');
    });
}

public function down(): void
{
    Schema::table('mahasiswas', function (Blueprint $table) {
        $table->dropForeign(['prodi_id']);
        $table->dropColumn('prodi_id');
    });
}

};
