<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('assessed_by')->constrained('users')->onDelete('cascade');
            $table->integer('attendance_score')->default(0);
            $table->integer('discipline_score')->default(0);
            $table->integer('performance_score')->default(0);
            $table->integer('initiative_score')->default(0);
            $table->integer('cooperation_score')->default(0);
            $table->text('strengths')->nullable();
            $table->text('weaknesses')->nullable();
            $table->text('recommendations')->nullable();
            $table->integer('total_score')->default(0);
            $table->string('grade')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assessments');
    }
};

