<?php

namespace App\Http\Controllers;

use App\Models\BusinessCard; // Ավելացրեք սա
use Illuminate\Http\Request;

class PublicCardController extends Controller
{
    /**
     * Ցուցադրել հանրային քարտի էջը։
     */
    // Route Model Binding-ի շնորհիվ Laravel-ն ավտոմատ գտնում է $card-ը slug-ով
    public function show(BusinessCard $card)
    {
        // Ուղարկում ենք գտնված քարտի տվյալները view-ին
        return view('public-show', compact('card'));
    }
}