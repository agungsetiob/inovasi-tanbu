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
        Schema::create('indikator_proposal', function (Blueprint $table) {
            $table->id();
            $table->foreignId('indikator_id')->constrained('indikators');
            $table->foreignId('proposal_id')->constrained('proposals');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposal_indikator');
    }
};
