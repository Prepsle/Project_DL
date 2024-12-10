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
        Schema::table('dia_diem_bai_viets', function (Blueprint $table) {
            $table->foreign(['ma_bai_viet'])->references(['ma_bai_viet'])->on('bai_viets')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['ma_dia_diem'])->references(['ma_dia_diem'])->on('dia_diems')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dia_diem_bai_viets', function (Blueprint $table) {
            $table->dropForeign('dia_diem_bai_viets_ma_bai_viet_foreign');
            $table->dropForeign('dia_diem_bai_viets_ma_dia_diem_foreign');
        });
    }
};
