<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessCard extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'title_color',
        'subtitle',
        'slug',
        'brand_color',
        'icon_bg_color',  
        'icon_bg_opacity',
        'logo_bg_color',
        'logo_bg_opacity',
        'logo_path',
        'bg_overlay_color', 
        'bg_overlay_opacity',
        'background_image_path',
        'links',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'title' => 'array',     // JSON (բազմալեզու)
        'subtitle' => 'array',  // JSON (բազմալեզու)
        'links' => 'array',     // JSON (Հղում URL ADRESների ցուցակ)
    ];
}