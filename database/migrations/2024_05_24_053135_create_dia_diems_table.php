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
        Schema::create('dia_diems', function (Blueprint $table) {
            $table->id('ma_dia_diem');
            $table->string('ten_dia_diem');
            $table->string('dia_chi');
            $table->mediumText('mo_ta_dia_diem');
            $table->string('hinh_anh_dia_diem');
            $table->unsignedBigInteger('ma_loai_dia_diem');
            $table->foreign('ma_loai_dia_diem')->references('ma_loai_dia_diem')->on('loai_dia_diems')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('ma_xa_phuong');
            $table->foreign('ma_xa_phuong')->references('ma_xa_phuong')->on('xa_phuongs')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dia_diems');
    }
};
