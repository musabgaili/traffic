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
        // rasperry pi table
        Schema::create('ras', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id');
            // group id
            $table->foreignId('group_id')->nullable()->constrained('ras_groups')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ras');
    }
};
