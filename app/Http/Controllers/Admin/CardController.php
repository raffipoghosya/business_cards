<?php

namespace App\Http\Controllers\Admin;

use App\Models\BusinessCard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request; // Սա անհրաժեշտ է update-ի համար
use App\Http\Requests\Admin\StoreCardRequest; // Մեր վավերացման ֆայլը
use Illuminate\Support\Facades\Storage; // Սա անհրաժեշտ է ֆայլերի հետ աշխատելու համար

class CardController extends Controller
{
    /**
     * Ցուցադրում է բոլոր քարտերի ցանկը (Dashboard)
     */
    public function index()
    {
        // Գտնում ենք բոլոր քարտերը ՏԲ-ից
        $cards = BusinessCard::all();

        // Ուղարկում ենք դրանք view ֆայլին
        return view('admin.index', compact('cards'));
    }

    /**
     * Ցուցադրում է նոր քարտ ստեղծելու ֆորման
     */
    public function create()
    {
        // Օգտագործում ենք Ձեր նշած ճշգրիտ ցանկը
        $availableLinks = [
            ['key' => 'phone',     'label' => 'Հեռախոսահամար'],
            ['key' => 'sms',       'label' => 'SMS հեռախոսահամար'],
            ['key' => 'mail',      'label' => 'Էլ. փոստ (Email)'],
            ['key' => 'website',   'label' => 'Վեբ էջ'],
            ['key' => 'whatsapp',  'label' => 'WhatsApp'],
            ['key' => 'viber',     'label' => 'Viber'],
            ['key' => 'facebook',  'label' => 'Facebook'],
            ['key' => 'messenger', 'label' => 'Messenger'],
            ['key' => 'instagram', 'label' => 'Instagram'],
            ['key' => 'location',  'label' => 'Location (Google Maps)'],
        ];
    
        // Փոխանցում ենք այս ցանկը view-ին
        return view('admin.create', compact('availableLinks'));
    }


    /**
     * Պահպանում է նոր ստեղծված քարտը ՏԲ-ում
     */
    public function store(StoreCardRequest $request)
    {
        // 1. Վերցնում ենք բոլոր վավերացված տվյալները
        $validatedData = $request->validated();

        // 2. Ֆայլերի մշակում
        if ($request->hasFile('logo')) {
            // Պահպանում ենք 'storage/app/public/logos' պանակում
            $logoPath = $request->file('logo')->store('logos', 'public');
            $validatedData['logo_path'] = $logoPath;
        }
        if ($request->hasFile('background_image')) {
            // Պահպանում ենք 'storage/app/public/backgrounds' պանակում
            $bgPath = $request->file('background_image')->store('backgrounds', 'public');
            $validatedData['background_image_path'] = $bgPath;
        }

        // 3. Հղումների (Links) մշակում (Ձեր ցանկով)
        $processedLinks = [];
        $availableLinks = [
            ['key' => 'phone',     'label' => 'Հեռախոսահամար'],
            ['key' => 'sms',       'label' => 'SMS հեռախոսահամար'],
            ['key' => 'mail',      'label' => 'Էլ. փոստ (Email)'],
            ['key' => 'website',   'label' => 'Վեբ էջ'],
            ['key' => 'whatsapp',  'label' => 'WhatsApp'],
            ['key' => 'viber',     'label' => 'Viber'],
            ['key' => 'facebook',  'label' => 'Facebook'],
            ['key' => 'messenger', 'label' => 'Messenger'],
            ['key' => 'instagram', 'label' => 'Instagram'],
            ['key' => 'location',  'label' => 'Location (Google Maps)'],
        ];

        $inputLinks = $validatedData['links'] ?? []; // Ֆորմայից եկած տվյալները

        foreach ($availableLinks as $link) {
            $key = $link['key'];
            
            $isActive = isset($inputLinks[$key]['active']);
            $value = $inputLinks[$key]['value'] ?? null;

            // Պահպանում ենք, եթե նշված է ԵՎ դաշտը դատարկ չէ
            if ($isActive && !empty($value)) {
                $processedLinks[] = [
                    'key' => $key,
                    'label' => $link['label'],
                    'value' => $value,
                    'active' => true 
                ];
            }
        }
        
        // Պահպանում ենք մշակված ցանկը
        $validatedData['links'] = $processedLinks; 
        
        // 4. *** ԿԱՐԵՎՈՐ ԹԱՐՄԱՑՈՒՄ ՁԵՐ ՊԱՀԱՆՋՈՎ ***
        // Սահմանում ենք, որ լոգոյի ֆոնի գույնը նույնն է, ինչ բրենդային գույնը
        $validatedData['logo_bg_color'] = $validatedData['brand_color'];

        // 5. Ստեղծում ենք քարտը
        BusinessCard::create($validatedData);

        // 6. Վերադառնում ենք դաշբորդ
        return redirect()->route('dashboard')->with('success', 'Քարտը հաջողությամբ ստեղծվեց։');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Սա կիրականացնենք հաջորդ քայլերում (հանրային էջի համար)
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Սա կիրականացնենք հաջորդ քայլերում
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Սա կիրականացնենք հաջորդ քայլերում
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Սա կիրականացնենք հաջորդ քայլերում
    }
}