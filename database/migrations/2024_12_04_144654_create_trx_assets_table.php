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
        Schema::create('trx_asset', function (Blueprint $table) {
            $table->id();
            $table->dateTime('dateTime');
            $table->enum('jenis_pemantauan', ['bergerak','tidak_bergerak']);
            $table->integer('jumlah_baik');
            $table->integer('jumlah_kurang_baik');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trx_asset');
    }
};
