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
        Schema::create('performance_scores', function (Blueprint $table) {
            $table->id();
            $table ->foreignId('user_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->decimal('attendance_score', 10 ,2)->default(0);

            //score based on active system usage (0-100)
            $table->decimal('activity_score', 10, 2)->default(0);
            
            //score based on task completion (0-100)
            $table->decimal('task_completion_score', 10, 2)->default(0);

            //combined final score (0-100)
            $table->decimal('overall_score', 10, 2)->default(0);

            //employee ranking position
            $table->integer('rank')->nullable();

            //month being evaluated
            $table->date('evaluated_month');

            $table->timestamps();
        });
    }
 

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('performance_scores');
    }
};
