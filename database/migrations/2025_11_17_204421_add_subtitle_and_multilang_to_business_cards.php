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
            // Վերնագիրը դարձնում ենք text, որպեսզի JSON տեղավորվի
            $table->text('title')->change();
            // Ավելացնում ենք Բնորոշումը
            $table->text('subtitle')->nullable()->after('title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('business_cards', function (Blueprint $table) {
            //
        });
    }
};
