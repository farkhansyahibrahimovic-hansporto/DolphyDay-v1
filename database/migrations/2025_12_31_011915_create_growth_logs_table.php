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
        Schema::create('growth_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('reflection')->nullable();
            $table->enum('mood', ['peaceful', 'hopeful', 'content', 'growing', 'struggling'])->nullable();
            $table->date('log_date');
            $table->timestamps();
            
            $table->index('user_id');
            $table->index('log_date');
            $table->index('mood');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('growth_logs');
    }
};