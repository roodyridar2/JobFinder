<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('company')->nullable();
            $table->string('category')->nullable();
            $table->string('job_region')->nullable();
            $table->string('job_type')->nullable();
            $table->string('experience')->nullable();
            $table->decimal('salary', 10, 2)->nullable();
            $table->string('gender')->nullable();
            $table->string('application_deadline')->nullable();
            $table->text('jobdescription')->nullable();
            $table->text('responsibilities')->nullable();
            $table->text('education_experience')->nullable();
            $table->string('image')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
