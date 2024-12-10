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
        Schema::create('dia_diem_bai_viets', function (Blueprint $table) {
            $table->unsignedBigInteger('ma_dia_diem');
            $table->unsignedBigInteger('ma_bai_viet')->index('dia_diem_bai_viets_ma_bai_viet_foreign');
            $table->timestamps();

            $table->primary(['ma_dia_diem', 'ma_bai_viet']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dia_diem_bai_viets');
    }
};
