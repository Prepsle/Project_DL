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
        Schema::create('bai_viets', function (Blueprint $table) {
            $table->id('ma_bai_viet');
            $table->string('ten_bai_viet');
            $table->mediumText('mo_ta_ngan');
            $table->mediumText('noi_dung_bai_viet');
            $table->string('hinh_anh_bai_viet');
            $table->datetime('ngay_dang_bai_viet');
            $table->integer('luot_xem_bai_viet')->default(0);
            $table->unsignedBigInteger('nguoi_dang_bai_viet');
            $table->foreign('nguoi_dang_bai_viet')->references('ma_tai_khoan')->on('tai_khoans')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bai_viets');
    }
};
