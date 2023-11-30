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
        Schema::table('wallet_categories', function (Blueprint $table) {
            $table->text('description');
            $table->boolean('is_autosave')->default(false);
            $table->boolean('is_term_deposit')->default(false);
            $table->boolean('is_lock')->default(false);
            $table->json('autosave_detail')->nullable();
            $table->json('term_deposit_detail')->nullable();
            $table->json('lock_detail')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('wallet_categories', function (Blueprint $table) {
            $table->dropColumn('description');
            $table->dropColumn('is_autosave');
            $table->dropColumn('is_term_deposit');
            $table->dropColumn('is_lock');
            $table->dropColumn('autosave_detail');
            $table->dropColumn('term_deposit_detail');
            $table->dropColumn('lock_detail');
        });
    }
};
