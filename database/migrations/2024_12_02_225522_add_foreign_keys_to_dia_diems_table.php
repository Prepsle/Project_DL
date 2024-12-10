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
        Schema::table('dia_diems', function (Blueprint $table) {
            $table->foreign(['ma_danh_muc'], 'dia_diems_ibfk_1')->references(['ma_danh_muc'])->on('danh_muc_du_liches')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['ma_loai_dia_diem'])->references(['ma_loai_dia_diem'])->on('loai_dia_diems')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['ma_xa_phuong'])->references(['ma_xa_phuong'])->on('xa_phuongs')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dia_diems', function (Blueprint $table) {
            $table->dropForeign('dia_diems_ibfk_1');
            $table->dropForeign('dia_diems_ma_loai_dia_diem_foreign');
            $table->dropForeign('dia_diems_ma_xa_phuong_foreign');
        });
    }
};
