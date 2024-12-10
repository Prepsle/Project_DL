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
        Schema::table('order_details', function (Blueprint $table) {
            $table->foreign(['ma_bai_viet'], 'bai_viet_fk')->references(['ma_bai_viet'])->on('bai_viets')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['order_id'], 'gio_hang_fk')->references(['id'])->on('gio_hangs')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_details', function (Blueprint $table) {
            $table->dropForeign('bai_viet_fk');
            $table->dropForeign('gio_hang_fk');
        });
    }
};
