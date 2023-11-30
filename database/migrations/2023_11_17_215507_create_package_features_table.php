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
        Schema::create('package_features', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_id')
                ->references('id')
                ->on('packages')
                ->cascadeOnDelete();
            $table->foreignId('feature_id')
                ->references('id')
                ->on('features')
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('package_features', function (Blueprint $table) {
            $table->dropForeign(['package_id']);
            $table->dropForeign(['feature_id']);
        });
        Schema::dropIfExists('package_features');
    }
};
