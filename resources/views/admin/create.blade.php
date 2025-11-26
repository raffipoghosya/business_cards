<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Ստեղծել նոր թվային քարտ
        </h2>
    </x-slot>

    <div class="w-full bg-gray-100 dark:bg-gray-100 py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gradient-to-br from-white to-gray-50 overflow-hidden shadow-xl sm:rounded-lg">
                
                <div class="p-6 md:p-10 text-gray-900 dark:text-gray-900">
                    
                    <form method="POST" action="{{ route('cards.store') }}" enctype="multipart/form-data">
                        @csrf
                        
                        {{-- Հիմնական Կարգավորումներ Բլոկ (Անփոփոխ) --}}
                        <div class="bg-gray-800 p-6 rounded-2xl border border-gray-700/50 mb-8">
                            <h3 class="text-lg font-semibold text-black mb-4 flex items-center gap-2">
                                <svg class="h-6 w-6 text-indigo-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.21 1.434l-1.003.827c-.293.24-.438.613-.43.992a6.759 6.759 0 010 1.25c.008.378.138.75.43.99l1.005.828c.424.35.532.955.21 1.434l-1.298 2.247a1.125 1.125 0 01-1.369.49l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 01-.22.128c-.332.183-.582.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.063-.374-.313-.686-.645-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.075-.124l-1.217.456a1.125 1.125 0 01-1.37-.49l-1.296-2.247a1.125 1.125 0 01.21-1.434l1.004-.827c.292-.24.437-.613.43-.992a6.759 6.759 0 010-1.25c-.008-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.21-1.434l1.298-2.247c.303-.52.934-.686 1.37-.49l1.217.456c.355.133.75.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.213-1.28z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                Հիմնական տեղեկություններ և Ֆայլեր
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                
                                {{-- Բազմալեզու Վերնագրեր և Բնորոշումներ --}}
                                <div class="bg-indigo-700/50 p-4 rounded-lg border border-indigo-600/50">
                                    <label for="title_en" class="block font-semibold text-xl  text-white ">Վերնագիր (English)</label>
                                    <input id="title_en" class="block mt-1 w-full bg-gray-900 border-indigo-500 text-base text-black focus:border-indigo-400 focus:ring-indigo-400 rounded-md shadow-sm" type="text" name="title[en]" value="{{ old('title.en') }}" required autofocus>
                                    <x-input-error :messages="$errors->get('title.en')" class="mt-2" />
                                </div>
                                <div class="bg-indigo-700/50 p-4 rounded-lg border border-indigo-600/50">
                                    <label for="subtitle_en" class="block font-semibold text-xl  text-white ">Բնորոշում (English)</label>
                                    <input id="subtitle_en" class="block mt-1 w-full bg-gray-900 border-indigo-500 text-base text-black focus:border-indigo-400 focus:ring-indigo-400 rounded-md shadow-sm" type="text" name="subtitle[en]" value="{{ old('subtitle.en') }}">
                                    <x-input-error :messages="$errors->get('subtitle.en')" class="mt-2" />
                                </div>

                                <div class="bg-orange-700/50 p-4 rounded-lg border border-orange-600/50">
                                    <label for="title_ru" class="block font-semibold text-xl  text-white ">Վերնագիր (Russian)</label>
                                    <input id="title_ru" class="block mt-1 w-full bg-gray-900 border-orange-500 text-base text-black focus:border-orange-400 focus:ring-orange-400 rounded-md shadow-sm" type="text" name="title[ru]" value="{{ old('title.ru') }}">
                                    <x-input-error :messages="$errors->get('title.ru')" class="mt-2" />
                                </div>
                                <div class="bg-orange-700/50 p-4 rounded-lg border border-orange-600/50">
                                    <label for="subtitle_ru" class="block font-semibold text-xl  text-white ">Բնորոշում (Russian)</label>
                                    <input id="subtitle_ru" class="block mt-1 w-full bg-gray-900 border-orange-500 text-base text-black focus:border-orange-400 focus:ring-orange-400 rounded-md shadow-sm" type="text" name="subtitle[ru]" value="{{ old('subtitle.ru') }}">
                                    <x-input-error :messages="$errors->get('subtitle.ru')" class="mt-2" />
                                </div>

                                <div class="bg-red-700/50 p-4 rounded-lg border border-red-600/50">
                                    <label for="title_hy" class="block font-semibold text-xl  text-white ">Վերնագիր (Armenian)</label>
                                    <input id="title_hy" class="block mt-1 w-full bg-gray-900 border-red-500 text-base text-black focus:border-red-400 focus:ring-red-400 rounded-md shadow-sm" type="text" name="title[hy]" value="{{ old('title.hy') }}">
                                    <x-input-error :messages="$errors->get('title.hy')" class="mt-2" />
                                </div>
                                <div class="bg-red-700/50 p-4 rounded-lg border border-red-600/50">
                                    <label for="subtitle_hy" class="block font-semibold text-xl  text-white ">Բնորոշում (Armenian)</label>
                                    <input id="subtitle_hy" class="block mt-1 w-full bg-gray-900 border-red-500 text-base text-black focus:border-red-400 focus:ring-red-400 rounded-md shadow-sm" type="text" name="subtitle[hy]" value="{{ old('subtitle.hy') }}">
                                    <x-input-error :messages="$errors->get('subtitle.hy')" class="mt-2" />
                                </div>

                                {{-- URL ADRESS --}}
                                <div class="md:col-span-2 mt-4">
                                    <label for="slug" class="block font-semibold text-xl  text-white ">Հղում ( URL ADRESS)</label>
                                    <input id="slug" class="block mt-1 w-full bg-gray-900 border-gray-500 text-base text-black focus:border-indigo-400 focus:ring-indigo-400 rounded-md shadow-sm" type="text" name="slug" value="{{ old('slug') }}" required>
                                    <x-input-error :messages="$errors->get('slug')" class="mt-2" />
                                </div>
                                
                                {{-- Ֆայլերի Վերբեռնում --}}
                                <div>
                                    <label for="logo" class="block font-semibold text-xl  text-white ">Վերբեռնել Լոգո</label>
                                    <input id="logo" type="file" name="logo" class="block w-full mt-1 text-sm text-gray-400 border border-gray-600 rounded-md cursor-pointer bg-gray-900 focus:outline-none file:mr-4 file:py-2 file:px-4 file:rounded-l-md file:border-0 file:font-medium file:bg-gray-700 file:text-black hover:file:bg-gray-600">
                                    <x-input-error :messages="$errors->get('logo')" class="mt-2" />
                                </div>

                                <div>
                                    <label for="background_image" class="block font-semibold text-xl  text-white ">Վերբեռնել Ընդանուր ետնանկար</label>
                                    <input id="background_image" type="file" name="background_image" class="block w-full mt-1 text-sm text-gray-400 border border-gray-600 rounded-md cursor-pointer bg-gray-900 focus:outline-none file:mr-4 file:py-2 file:px-4 file:rounded-l-md file:border-0 file:font-medium file:bg-gray-700 file:text-black hover:file:bg-gray-600">
                                    <x-input-error :messages="$errors->get('background_image')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        {{-- Դիզայնի Կարգավորումներ Բլոկ (Վերադասավորված) --}}
                        <div class="bg-gray-800 p-6 rounded-2xl border border-gray-700/50 mb-8">
                            <h3 class="text-lg font-semibold text-black mb-4 flex items-center gap-2">
                                <svg class="h-6 w-6 text-indigo-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.53 16.122a3 3 0 00-5.78 1.128 2.25 2.25 0 01-2.43 2.43a4.5 4.5 0 008.636-3.558 3.001 3.001 0 00-1.426-5.78zM12 6.344a4.5 4.5 0 01.37-1.831c.126-.31.29-.603.49-.886a4.5 4.5 0 018.11 3.558 3.001 3.001 0 01-1.426 5.78z" /></svg>
                                Դիզայնի Կարգավորումներ
                            </h3>
                            
                            {{-- 1. Լոգոյի ֆոնի Գույն և Թափանցիկություն --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                {{-- Ձախ: Լոգոյի ֆոնի Գույն --}}
                                <div>
                                    <label for="brand_color" class="block font-semibold text-xl  text-white ">Լոգոյի տակի ֆոն (Գույն)</label>
                                    <input id="brand_color" type="color" name="brand_color" value="{{ old('brand_color', '#1E88E5') }}" class="block mt-1 w-full h-12 border-gray-600 bg-gray-900 focus:border-indigo-400 focus:ring-indigo-400 rounded-md shadow-sm cursor-pointer">
                                    <x-input-error :messages="$errors->get('brand_color')" class="mt-2" />
                                </div>
                                {{-- Աջ: Լոգոյի ֆոնի Թափանցիկություն --}}
                                <div>
                                    <label for="logo_bg_opacity" id="logo_bg_opacity_label" class="block font-semibold text-xl  text-white ">Լոգոյի ֆոնի թափանցիկություն: {{ old('logo_bg_opacity', 1.0) }}</label>
                                    <input 
                                        id="logo_bg_opacity" 
                                        type="range" 
                                        name="logo_bg_opacity" 
                                        value="{{ old('logo_bg_opacity', 1.0) }}" 
                                        min="0" max="1" step="0.01" 
                                        class="block mt-4 w-full h-2 bg-gray-700 rounded-lg appearance-none cursor-pointer accent-indigo-500"
                                        oninput="updateOpacityLabel(this.value)">
                                    <x-input-error :messages="$errors->get('logo_bg_opacity')" class="mt-2" />
                                </div>
                            </div>

                            {{-- 2. Վերնագրի Գույն --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                {{-- Ձախ: Վերնագրի Գույն --}}
                                <div class="md:col-span-1">
                                    <label for="title_color" class="block font-semibold text-xl  text-white ">Վերնագրի Տեքստի Գույն</label>
                                    <input id="title_color" type="color" name="title_color" value="{{ old('title_color', '#ffffff') }}" class="block mt-1 w-full h-12 border-gray-600 bg-gray-900 focus:border-indigo-400 focus:ring-indigo-400 rounded-md shadow-sm cursor-pointer">
                                    <x-input-error :messages="$errors->get('title_color')" class="mt-2" />
                                </div>
                                {{-- Աջ: Դատարկ (Կարող է լինել ապագա տեքստի թափանցիկություն) --}}
                                <div class="md:col-span-1">
                                    {{-- Այստեղ կարող է ավելացվել տեքստի թափանցիկությունը, եթե անհրաժեշտ լինի --}}
                                </div>
                            </div>
                            
                            {{-- 3. Իկոնկաների ֆոնի Գույն և Թափանցիկություն --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {{-- Ձախ: Իկոնկաների ֆոնի Գույն --}}
                                <div>
                                    <label for="icon_bg_color" class="block font-semibold text-xl  text-white ">Իկոնկաների ֆոնի գույն</label>
                                    <input id="icon_bg_color" type="color" name="icon_bg_color" value="{{ old('icon_bg_color', '#ffffff') }}" class="block mt-1 w-full h-12 border-gray-600 bg-gray-900 focus:border-indigo-400 focus:ring-indigo-400 rounded-md shadow-sm cursor-pointer">
                                    <x-input-error :messages="$errors->get('icon_bg_color')" class="mt-2" />
                                </div>
                                {{-- Աջ: Իկոնկաների ֆոնի Թափանցիկություն --}}
                                <div>
                                    <label for="icon_bg_opacity" id="icon_bg_opacity_label" class="block font-semibold text-xl  text-white ">Իկոնկաների ֆոնի թափանցիկություն: {{ old('icon_bg_opacity', 1.0) }}</label>
                                    <input 
                                        id="icon_bg_opacity" 
                                        type="range" 
                                        name="icon_bg_opacity" 
                                        value="{{ old('icon_bg_opacity', 1.0) }}" 
                                        min="0" max="1" step="0.01" 
                                        class="block mt-4 w-full h-2 bg-gray-700 rounded-lg appearance-none cursor-pointer accent-indigo-500"
                                        oninput="updateIconOpacityLabel(this.value)">
                                    <x-input-error :messages="$errors->get('icon_bg_opacity')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        {{-- Ֆոնի Մգացման (Overlay) Կարգավորումներ Բլոկ (Վերադասավորված) --}}
                        <div class="bg-gray-800 p-6 rounded-2xl border border-gray-700/50 mb-8">
                            <h3 class="text-lg font-semibold text-black mb-4 flex items-center gap-2">
                                Ֆոնի Մգացման (Overlay) Կարգավորումներ
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {{-- Ձախ: Overlay Գույն --}}
                                <div>
                                    <label for="bg_overlay_color" class="block font-semibold text-xl  text-white ">Ընդանուր ֆոնի գույն (Overlay)</label>
                                    <input id="bg_overlay_color" type="color" name="bg_overlay_color" 
                                           value="{{ old('bg_overlay_color', '#151212') }}" 
                                           class="block mt-1 w-full h-12 border-gray-600 bg-gray-900 focus:border-indigo-400 focus:ring-indigo-400 rounded-md shadow-sm cursor-pointer">
                                    <x-input-error :messages="$errors->get('bg_overlay_color')" class="mt-2" />
                                </div>
                                {{-- Աջ: Overlay Թափանցիկություն --}}
                                <div>
                                    <label for="bg_overlay_opacity" id="bg_overlay_opacity_label" class="block font-semibold text-xl  text-white ">
                                        Մգացման թափանցիկություն: {{ old('bg_overlay_opacity', 0.3) }}
                                    </label>
                                    <input 
                                        id="bg_overlay_opacity" 
                                        type="range" 
                                        name="bg_overlay_opacity" 
                                        value="{{ old('bg_overlay_opacity', 0.3) }}" 
                                        min="0" max="1" step="0.01" 
                                        class="block mt-4 w-full h-2 bg-gray-700 rounded-lg appearance-none cursor-pointer accent-indigo-500"
                                        oninput="document.getElementById('bg_overlay_opacity_label').innerText = 'Մգացման թափանցիկություն: ' + Number(this.value).toFixed(2)">
                                    <x-input-error :messages="$errors->get('bg_overlay_opacity')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                        
                        {{-- Share Buttons Ֆոնի Կարգավորումներ Բլոկ (Գույն/Թափանցիկություն) --}}
                        <div class="bg-gray-800 p-6 rounded-2xl border border-gray-700/50 mb-8">
                            <h3 class="text-lg font-semibold text-black mb-4 flex items-center gap-2">
                                Share Buttons Ֆոնի Կարգավորումներ
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {{-- Ձախ: Share Button Գույն --}}
                                <div>
                                    <label for="share_btn_bg_color" class="block font-semibold text-xl  text-white ">Share Button Ֆոնի Գույն</label>
                                    <div class="flex items-center gap-3 mt-1">
                                        <input type="color" id="share_btn_bg_color_picker"
                                            class="h-10 w-10 rounded cursor-pointer border-0 p-0"
                                            value="{{ old('share_btn_bg_color', '#ffffff') }}"
                                            oninput="document.getElementById('share_btn_bg_color').value = this.value">
                                        <input id="share_btn_bg_color" class="block mt-1 w-full bg-gray-900 border-gray-600 text-black rounded-md shadow-sm" type="text" name="share_btn_bg_color"
                                            value="{{ old('share_btn_bg_color', '#ffffff') }}" />
                                    </div>
                                    <x-input-error :messages="$errors->get('share_btn_bg_color')" class="mt-2" />
                                </div>
                                {{-- Աջ: Share Button Թափանցիկություն --}}
                                <div>
                                    <label for="share_btn_bg_opacity" class="block font-semibold text-xl  text-white ">Share Buttons Ֆոնի թափանցիկություն</label>
                                    <div class="flex items-center gap-4 mt-4">
                                        <input type="range" id="share_btn_bg_opacity_range" name="share_btn_bg_opacity" min="0" max="100" value="{{ old('share_btn_bg_opacity', 100) }}"
                                            class="w-full h-2 bg-gray-700 rounded-lg appearance-none cursor-pointer accent-indigo-500"
                                            oninput="document.getElementById('share_btn_bg_opacity_val').innerText = this.value + '%'">
                                        <span id="share_btn_bg_opacity_val" class="text-black font-mono w-12">{{ old('share_btn_bg_opacity', 100) }}%</span>
                                    </div>
                                    <x-input-error :messages="$errors->get('share_btn_bg_opacity')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        {{-- «Պահպանել կոնտակտը» Կոճակի Կարգավորումներ Բլոկ (Գույն/Թափանցիկություն) --}}
                        <div class="bg-gray-800 p-6 rounded-2xl border border-gray-700/50 mb-8">
                            <h3 class="text-lg font-semibold text-black mb-4 flex items-center gap-2">
                                «Պահպանել կոնտակտը» Կոճակի Կարգավորումներ
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {{-- Ձախ: Կոճակի Ֆոնի Գույն --}}
                                <div>
                                    <label for="contact_btn_color" class="block font-semibold text-xl  text-white ">Կոճակի Ֆոնի Գույն</label>
                                    <div class="flex items-center gap-3 mt-1">
                                        <input type="color" id="contact_btn_color_picker"
                                            class="h-10 w-10 rounded cursor-pointer border-0 p-0"
                                            value="{{ old('contact_btn_color', '#555555') }}"
                                            oninput="document.getElementById('contact_btn_color').value = this.value">
                                        <input id="contact_btn_color" class="block mt-1 w-full bg-gray-900 border-gray-600 text-black rounded-md shadow-sm" type="text" name="contact_btn_color"
                                            value="{{ old('contact_btn_color', '#555555') }}" />
                                    </div>
                                    <x-input-error :messages="$errors->get('contact_btn_color')" class="mt-2" />
                                </div>
                                {{-- Աջ: Կոճակի Ֆոնի Թափանցիկություն --}}
                                <div>
                                    <label for="contact_btn_opacity" class="block font-semibold text-xl  text-white ">Կոճակի Ֆոնի թափանցիկություն</label>
                                    <div class="flex items-center gap-4 mt-4">
                                        <input type="range" id="contact_btn_opacity_range" name="contact_btn_opacity" min="0" max="100"
                                            value="{{ old('contact_btn_opacity', 100) }}"
                                            class="w-full h-2 bg-gray-700 rounded-lg appearance-none cursor-pointer accent-indigo-500"
                                            oninput="document.getElementById('contact_btn_opacity_val_create').innerText = this.value + '%'">
                                        <span id="contact_btn_opacity_val_create" class="text-black font-mono w-12">
                                            {{ old('contact_btn_opacity', 100) }}%
                                        </span>
                                    </div>
                                    <x-input-error :messages="$errors->get('contact_btn_opacity')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        {{-- Կոնտակտային Հղումներ Բլոկ (Անփոփոխ) --}}
                        <div class="bg-gray-100 p-6 rounded-2xl border border-gray-300 mb-8">
                            <h3 class="text-2xl font-semibold text-black mb-6 flex items-center gap-2">
                                <svg class="h-6 w-6 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244" /></svg>
                                Կոնտակտային Հղումներ (URL ADRESներ)
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                
                                @foreach ($availableLinks as $linkKey => $linkLabel)
                                    <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm transition duration-150 ease-in-out hover:shadow-md">
                                        <div class="flex items-center">
                                            <input type="checkbox" 
                                                   name="links[{{ $linkKey }}][active]" 
                                                   id="links-{{ $linkKey }}-active"
                                                   class="h-4 w-4 rounded border-gray-400 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                                   {{ old('links.'.$linkKey.'.active') ? 'checked' : '' }}>
                                            
                                            <label for="links-{{ $linkKey }}-active" class="ml-2 block text-lg font-semibold text-gray-900">
                                                Ակտիվացնել {{ $linkLabel }}
                                            </label>
                                        </div>
                                        <div class="mt-3">
                                            <label for="links-{{ $linkKey }}-value" class="sr-only">{{ $linkLabel }} (Արժեք)</label>
                                            <input 
                                                id="links-{{ $linkKey }}-value" 
                                                class="block mt-1 w-full bg-white border-gray-300 text-base text-gray-900 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" 
                                                type="text" 
                                                name="links[{{ $linkKey }}][value]" 
                                                value="{{ old('links.'.$linkKey.'.value') }}" 
                                                placeholder="Լրացրեք արժեքը այստեղ...">
                                            <x-input-error :messages="$errors->get('links.'.$linkKey.'.value')" class="mt-2" />
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                        
                        {{-- Պահպանել Կոճակ --}}
                        <div class="flex items-center justify-end mt-8 pt-8 border-t border-gray-300">
                            <button type="submit" class="inline-flex items-center justify-center px-10 py-4 bg-indigo-600 border-2 border-indigo-600 rounded-lg font-bold text-lg text-black uppercase tracking-wide hover:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg hover:shadow-xl">
                                Պահպանել
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    
    <script>
        // Լոգոյի թափանցիկության ֆունկցիա
        function updateOpacityLabel(value) {
            const formattedValue = Number(value).toFixed(2);
            const label = document.getElementById('logo_bg_opacity_label');
            if (label) {
                label.innerText = `Լոգոյի ֆոնի թափանցիկություն: ${formattedValue}`;
            }
        }

        // Իկոնկաների թափանցիկության ֆունկցիա
        function updateIconOpacityLabel(value) {
            const formattedValue = Number(value).toFixed(2);
            const label = document.getElementById('icon_bg_opacity_label');
            if (label) {
                label.innerText = `Իկոնկաների ֆոնի թափանցիկություն: ${formattedValue}`;
            }
        }

        // Թափանցիկության սկզբնական արժեքների ցուցադրում
        document.addEventListener('DOMContentLoaded', function() {
            // Initialization for Logo Opacity
            const slider = document.getElementById('logo_bg_opacity');
            if (slider) {
                updateOpacityLabel(slider.value);
            }

            // Initialization for Icon Opacity
            const iconSlider = document.getElementById('icon_bg_opacity');
            if (iconSlider) {
                updateIconOpacityLabel(iconSlider.value);
            }
            
            // Initialization for Background Overlay Opacity
            const overlaySlider = document.getElementById('bg_overlay_opacity');
            if (overlaySlider) {
                 document.getElementById('bg_overlay_opacity_label').innerText = 'Մգացման թափանցիկություն: ' + Number(overlaySlider.value).toFixed(2);
            }
            
            // Initialization for Share Button Opacity
            const shareBtnOpacityRange = document.getElementById('share_btn_bg_opacity_range');
            const shareBtnOpacityVal = document.getElementById('share_btn_bg_opacity_val');
            if (shareBtnOpacityRange && shareBtnOpacityVal) {
                shareBtnOpacityVal.innerText = shareBtnOpacityRange.value + '%';
            }
            
            // Initialization for Contact Button Opacity
            const contactBtnOpacityRange = document.getElementById('contact_btn_opacity_range');
            const contactBtnOpacityVal = document.getElementById('contact_btn_opacity_val_create');
            if (contactBtnOpacityRange && contactBtnOpacityVal) {
                contactBtnOpacityVal.innerText = contactBtnOpacityRange.value + '%';
            }
        });
    </script>
</x-app-layout>