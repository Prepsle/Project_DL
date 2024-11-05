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
        Schema::create('binh_luans', function (Blueprint $table) {
            $table->id('ma_binh_luan');
            $table->string('chi_tiet_binh_luan');
            $table->datetime('thoi_gian_binh_luan');
            $table->enum('trang_thai_binh_luan', ['chua_duyet', 'da_duyet'])->default('chua_duyet');
            $table->unsignedBigInteger('ma_tai_khoan');
            $table->foreign('ma_tai_khoan')->references('ma_tai_khoan')->on('tai_khoans')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('ma_bai_viet');
            $table->foreign('ma_bai_viet')->references('ma_bai_viet')->on('bai_viets')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('binh_luans');
    }
};
