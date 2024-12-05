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
        Schema::create('trx_asset_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pemantauan');
            $table->unsignedBigInteger('id_asset');
            $table->enum('status', ['baik','kurang_baik']);
            $table->foreign('id_pemantauan')->references('id')->on('trx_asset')->cascadeOnDelete();
            $table->foreign('id_asset')->references('id')->on('m_asset')->cascadeOnDelete();        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trx_asset_detail');
    }
};
