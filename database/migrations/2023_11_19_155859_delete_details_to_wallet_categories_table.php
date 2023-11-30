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
            $table->dropColumn('autosave_detail');
            $table->dropColumn('term_deposit_detail');
            $table->dropColumn('lock_detail');

            // add account_number
            $table->string('account_number', 25)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('wallet_categories', function (Blueprint $table) {
            $table->json('autosave_detail')->nullable();
            $table->json('term_deposit_detail')->nullable();
            $table->json('lock_detail')->nullable();

            $table->dropColumn('account_number');
        });
    }
};
