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
            $table->bigIncrements('ma_binh_luan');
            $table->string('chi_tiet_binh_luan');
            $table->dateTime('thoi_gian_binh_luan');
            $table->enum('trang_thai_binh_luan', ['da_xac_nhan', 'khong_xac_nhan', 'cho_xac_nhan'])->default('cho_xac_nhan');
            $table->unsignedBigInteger('ma_tai_khoan')->index('binh_luans_ma_tai_khoan_foreign');
            $table->unsignedBigInteger('ma_bai_viet')->index('binh_luans_ma_bai_viet_foreign');
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
