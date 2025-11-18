<?php

namespace App\Http\Controllers;

use App\Models\BusinessCard;
use Illuminate\Http\Request;

class PublicCardController extends Controller
{
    /**
     * Ցուցադրել հանրային քարտի էջը։
     */
    // Route Model Binding-ի շնորհիվ Laravel-ն ավտոմատ գտնում է $card-ը slug-ով (url_name)
    public function show(BusinessCard $card)
    {
        // --- 1. ICON STYLE CALCULATION (Հիմնական կոնտակտային կոճակներ) ---
        $iconBgColor = $card->icon_bg_color ?? '#ffffff';
        $iconBgOpacity = $card->icon_bg_opacity ?? 100;

        // Hex-ը (#ffffff) փոխակերպում ենք RGB-ի
        $icon_rgb = sscanf($iconBgColor, "#%02x%02x%02x");
        $ri = $icon_rgb[0] ?? 255;
        $gi = $icon_rgb[1] ?? 255;
        $bi = $icon_rgb[2] ?? 255;
        
        // Ստանում ենք վերջնական RGBA գույնը (օրինակ՝ rgba(255, 255, 255, 0.5))
        $icon_bg_rgba = sprintf("rgba(%d, %d, %d, %.2f)", $ri, $gi, $bi, $iconBgOpacity / 100);


        // --- 2. SHARE BUTTONS STYLE CALCULATION (Share բաժնի կոճակներ) ---
        // Սա նոր ավելացված ֆունկցիոնալն է
        $shareBgColor = $card->share_btn_bg_color ?? '#ffffff';
        $shareBgOpacity = $card->share_btn_bg_opacity ?? 100;

        // Hex-ը փոխակերպում ենք RGB-ի Share կոճակների համար
        $share_rgb = sscanf($shareBgColor, "#%02x%02x%02x");
        $rs = $share_rgb[0] ?? 255;
        $gs = $share_rgb[1] ?? 255;
        $bs = $share_rgb[2] ?? 255;

        $share_bg_rgba = sprintf("rgba(%d, %d, %d, %.2f)", $rs, $gs, $bs, $shareBgOpacity / 100);


        // Ուղարկում ենք գտնված քարտի տվյալները և երկու տեսակի գույները view-ին
        return view('public-show', compact('card', 'icon_bg_rgba', 'share_bg_rgba'));
    }
}