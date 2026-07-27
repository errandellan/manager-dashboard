<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('task_updates', function (Blueprint $table) {

            $table->enum('submission_type', [
                'file',
                'link'
            ])->nullable()->after('comment');

            $table->string('file_path')->nullable();

            $table->string('submission_link')->nullable();

            $table->text('manager_feedback')->nullable();

            $table->timestamp('submitted_at')->nullable();

            $table->timestamp('reviewed_at')->nullable();

        });
    }

    public function down(): void
    {
        Schema::table('task_updates', function (Blueprint $table) {

            $table->dropColumn([
                'submission_type',
                'file_path',
                'submission_link',
                'manager_feedback',
                'submitted_at',
                'reviewed_at'
            ]);

        });
    }
    
};