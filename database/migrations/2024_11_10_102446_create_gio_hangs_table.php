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
        Schema::create('gio_hangs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ma_tai_khoan')->index('fk-user_idx');
            $table->unsignedBigInteger('ma_bai_viet')->index('fk-bv_idx');
            $table->integer('quantity')->default(1);
            $table->decimal('price', 15, 0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gio_hangs');
    }
};
