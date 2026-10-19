<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gouvernances', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('role');
            $table->string('division')->nullable();
            $table->text('bio')->nullable();
            $table->text('quote')->nullable();
            $table->string('photo')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gouvernances');
    }
};

