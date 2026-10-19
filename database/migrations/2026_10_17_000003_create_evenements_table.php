<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('evenements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->dateTime('date_start');
            $table->dateTime('date_end')->nullable();
            $table->string('location')->default('Campus INSG Libreville');
            $table->text('summary')->nullable();
            $table->longText('description');
            $table->string('image')->nullable();
            $table->string('organizer')->default('INSG Gabon');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('evenements');
    }
};

