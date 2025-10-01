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
        Schema::create('gown_scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contestant_id')->constrained('contestants');
            $table->foreignId('criteria_id')->constrained('gown_criterias');
            $table->foreignId('scored_by')->constrained('users');
            $table->decimal('score', 5,2);
            $table->foreignId('updated_by')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gown_scores');
    }
};
