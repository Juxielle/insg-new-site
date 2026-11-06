<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('formations', function (Blueprint $table) {
            $table->string('study_mode')->nullable();
        });
        foreach (['Formation initiale', 'Formation continue'] as $mode) {
            DB::table('formations')->where('department', $mode)->update(['study_mode' => $mode]);
        }
    }

    public function down(): void
    {
        Schema::table('formations', fn (Blueprint $table) => $table->dropColumn('study_mode'));
    }
};
