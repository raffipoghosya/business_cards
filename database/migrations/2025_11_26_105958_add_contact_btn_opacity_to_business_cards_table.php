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
        Schema::table('business_cards', function (Blueprint $table) {
            // Ավելացնում է contact_btn_opacity դաշտը contact_btn_color դաշտից հետո (100% լռելյայն)
            $table->integer('contact_btn_opacity')->default(100)->after('contact_btn_color');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('business_cards', function (Blueprint $table) {
            $table->dropColumn('contact_btn_opacity');
        });
    }
};