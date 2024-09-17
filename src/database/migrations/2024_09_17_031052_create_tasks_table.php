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
            $table->foreignUuid('user_id')->constrained()->cascadeOnDelete();
            $table->foreignUuid('company_id')->constrained()->cascadeOnDelete();
            $table->foreignUuid('project_id')->constrained()->cascadeOnDelete();
            $table->tinyInteger('type_id')->nullable(true);
            $table->tinyInteger('state_id')->nullable(true);
            $table->foreignUuid('manager')->nullable(true)->constrained('users')->cascadeOnDelete();
            $table->tinyInteger('priority_id')->nullable(true);
            $table->tinyInteger('version_id')->nullable(true);
            $table->string('title');
            $table->longText('body')->nullable(true);
            $table->string('start_date')->nullable(true);
            $table->string('end_date')->nullable(true);
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
