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
        Schema::table('gio_hangs', function (Blueprint $table) {
            $table->foreign(['ma_bai_viet'], 'fk-bv')->references(['ma_bai_viet'])->on('bai_viets')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['ma_tai_khoan'], 'fk-user')->references(['ma_tai_khoan'])->on('tai_khoans')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gio_hangs', function (Blueprint $table) {
            $table->dropForeign('fk-bv');
            $table->dropForeign('fk-user');
        });
    }
};
