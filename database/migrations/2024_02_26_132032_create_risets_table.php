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
        Schema::create('risets', function (Blueprint $table) {
            $table->id();
            $table->text('judul');
            $table->text('latar');
            $table->text('hukum');
            $table->text('maksud');
            $table->text('ruang_lingkup');
            $table->text('target');
            $table->text('output');
            $table->text('manfaat');
            $table->text('dana');
            $table->string('rab');//rab
            $table->text('peneliti');
            $table->text('tahapan');
            $table->text('jangka');
            $table->text('jenis_sumber_data')->nullable();
            $table->text('analisa')->nullable();
            $table->text('teknik')->nullable();
            $table->string('url')->nullable();
            $table->foreignId('skpd_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('risets');
    }
};
