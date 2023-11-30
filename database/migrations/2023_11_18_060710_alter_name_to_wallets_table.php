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
        Schema::table('wallets', function (Blueprint $table) {
            $table->string('name');
            $table->integer('wallet_category_id');
            $table->boolean('is_have_target')->default(false);
            $table->double('target_amount', 16, 2)->default(0);
            $table->string('target_timeline')->nullable()->comment('Fill with days');
            $table->string('base_color')->default('#A2C579');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('wallets', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('wallet_category_id');
            $table->dropColumn('is_have_target');
            $table->dropColumn('target_amount');
            $table->dropColumn('target_timeline');
            $table->dropColumn('base_color');
        });
    }
};
