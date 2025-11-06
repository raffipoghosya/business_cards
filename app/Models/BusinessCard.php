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
    // Այստեղ ավելացնում ենք մեր բոլոր դաշտերը
    protected $fillable = [
        'title',
        'slug',
        'brand_color',
        'logo_bg_color',
        'logo_bg_opacity',
        'logo_path',
        'background_image_path',
        'links', // Ավելացնում ենք սա
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    // Ավելացնում ենք սա՝ ՏԲ-ի հետ ճիշտ աշխատելու համար
    protected $casts = [
        'links' => 'array',
    ];
}