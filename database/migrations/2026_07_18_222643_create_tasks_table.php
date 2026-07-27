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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();

            //manager who creates the task  
            $table->foreignId('assigned_by')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();

            //Employee to whom the task is assigned 
            $table->foreignId('assigned_to')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();

            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('status', ['pending', 'in_progress','submitted','approaved','returned'])->default('pending');
            $table->dateTime('due_date')->nullable();

            $table->dateTime('completed_at')->nullable();
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
