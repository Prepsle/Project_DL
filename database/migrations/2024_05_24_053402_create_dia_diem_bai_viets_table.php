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
            $table->foreign('ma_dia_diem')->references('ma_dia_diem')->on('dia_diems')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('ma_bai_viet');
            $table->foreign('ma_bai_viet')->references('ma_bai_viet')->on('bai_viets')->onUpdate('cascade')->onDelete('cascade');
            $table->primary(['ma_dia_diem', 'ma_bai_viet']);
            $table->timestamps();
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
