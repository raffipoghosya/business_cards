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
        'subtitle', // Ավելացրել ենք ենթավերնագիրը
        'slug',
        'brand_color',
        'logo_bg_color',
        'logo_bg_opacity',
        'logo_path',
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
        'links' => 'array',     // JSON (հղումների ցուցակ)
    ];
}