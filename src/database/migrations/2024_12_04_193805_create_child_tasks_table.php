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
        Schema::create('child_tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('user_id')->constrained();
            $table->foreignUuid('company_id')->constrained()->cascadeOnDelete();
            $table->foreignUuid('project_id')->constrained()->cascadeOnDelete();
            $table->foreignId('task_id')->constrained()->cascadeOnDelete();
            $table->foreignId('type_id')->nullable(true)->constrained()->nullOnDelete();
            $table->foreignId('state_id')->nullable(true)->constrained()->nullOnDelete();
            $table->foreignUuid('manager_id')->nullable(true)->constrained('users')->nullOnDelete();
            $table->foreignId('priority_id')->nullable(true)->constrained()->nullOnDelete();
            $table->foreignId('version_id')->nullable(true)->constrained()->nullOnDelete();
            $table->string('title');
            $table->longText('body')->nullable(true);
            $table->date('start_date')->nullable(true);
            $table->date('end_date')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('child_tasks');
    }
};
