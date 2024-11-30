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
        Schema::create('ras_ras_group', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ras_id')->constrained('ras')->onDelete('cascade');
            $table->foreignId('ras_group_id')->constrained('ras_groups')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ras_ras_group');
    }
};
