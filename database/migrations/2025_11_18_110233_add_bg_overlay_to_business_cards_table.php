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
            // Ավելացնում ենք ընդանուր ֆոնի գույնը (default: մուգ մոխրագույն)
            $table->string('bg_overlay_color')->default('#151212')->after('background_image_path');
            // Ավելացնում ենք ֆոնի թափանցիկությունը (default: 0.3)
            $table->float('bg_overlay_opacity')->default(0.3)->after('bg_overlay_color');
        });
    }
    
    public function down(): void
    {
        Schema::table('business_cards', function (Blueprint $table) {
            $table->dropColumn(['bg_overlay_color', 'bg_overlay_opacity']);
        });
    }
};
