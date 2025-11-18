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
            // after('icon_fg_color')-ի փոխարեն գրեք after('bg_overlay_opacity')
            $table->string('share_btn_bg_color')->default('#ffffff')->after('bg_overlay_opacity');
            $table->integer('share_btn_bg_opacity')->default(100)->after('share_btn_bg_color');
        });
    }
    
    public function down(): void
    {
        Schema::table('business_cards', function (Blueprint $table) {
            $table->dropColumn(['share_btn_bg_color', 'share_btn_bg_opacity']);
        });
    }
};
