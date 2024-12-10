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
        Schema::table('xa_phuongs', function (Blueprint $table) {
            $table->foreign(['ma_quan_huyen'])->references(['ma_quan_huyen'])->on('quan_huyens')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('xa_phuongs', function (Blueprint $table) {
            $table->dropForeign('xa_phuongs_ma_quan_huyen_foreign');
        });
    }
};
