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
            // Ավելացնում ենք գույնի և թափանցիկության դաշտերը
            $table->string('icon_bg_color')->default('#ffffff')->after('brand_color'); // Default սպիտակ
            $table->float('icon_bg_opacity')->default(1.0)->after('icon_bg_color'); // Default 100% տեսանելի
        });
    }
    
    public function down(): void
    {
        Schema::table('business_cards', function (Blueprint $table) {
            $table->dropColumn(['icon_bg_color', 'icon_bg_opacity']);
        });
    }
};
