<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('talent_criterias', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('percentage');
            $table->foreignId('added_by')->constrained('users');
            $table->foreignId('updated_by')->constrained('users');
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('talent_criterias');
    }
};
