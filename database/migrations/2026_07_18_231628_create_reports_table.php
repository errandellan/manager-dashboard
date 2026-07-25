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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();

            $table->foreignId('generated_by')
                ->constrained('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();  

                $table->string('report_name');
                $table->enum('report_type', ['attendance', 'activity', 'task', 'performance'])->default('attendance');
                
                $table->text('description')->nullable();

                //location of generated file if exported 
                $table->string('file_path')->nullable();
                $table->dateTime('generated_at');


                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
