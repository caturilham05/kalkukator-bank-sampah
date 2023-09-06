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
        Schema::create('sampah_data', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sampah_kategori_id');
            $table->string('nama');
            $table->text('deskripsi')->nullable();
            $table->text('foto')->nullable();
            $table->double('harga', 22, 2)->nullable();
            $table->string('satuan', 50)->nullable();
            $table->dateTime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
