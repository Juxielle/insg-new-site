<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('formations', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('level'); // BTS, Licence Pro, Master Pro
            $table->string('department'); // Finance, Marketing, Management, RH, Audit, etc.
            $table->string('duration')->default('3 ans');
            $table->text('summary')->nullable();
            $table->longText('description');
            $table->longText('admission_requirements')->nullable();
            $table->longText('career_opportunities')->nullable();
            $table->longText('curriculum')->nullable();
            $table->string('image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('formations');
    }
};

