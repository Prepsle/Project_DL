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
        Schema::create('thiet_bis', function (Blueprint $table) {
            $table->id('ma_thiet_bi');
            $table->string('ten_thiet_bi');
            $table->string('thiet_bi');
            $table->mediumText('mo_ta_thiet_bi');
            $table->string('hinh_anh_thiet_bi');
            $table->unsignedBigInteger('ma_loai_thiet_bi');
            $table->foreign('ma_loai_thiet_bi')->references('ma_loai_thiet_bi')->on('loai_thiet_bis')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('ma_dia_diem');
            $table->foreign('ma_dia_diem')->references('ma_dia_diem')->on('dia_diems')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thiet_bis');
    }
};
