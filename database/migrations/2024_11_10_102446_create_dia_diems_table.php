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
            $table->bigIncrements('ma_dia_diem');
            $table->string('ten_dia_diem');
            $table->string('dia_chi')->nullable();
            $table->mediumText('mo_ta_dia_diem');
            $table->string('hinh_anh_dia_diem');
            $table->unsignedBigInteger('ma_loai_dia_diem')->index('dia_diems_ma_loai_dia_diem_foreign');
            $table->unsignedBigInteger('ma_danh_muc')->nullable()->index('ma_danh_muc');
            $table->unsignedBigInteger('ma_xa_phuong')->index('dia_diems_ma_xa_phuong_foreign');
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
