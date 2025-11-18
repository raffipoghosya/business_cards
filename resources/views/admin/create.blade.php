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
                        
                        <div class="flex items-center border-b border-gray-200 pb-4 mb-6">
                            <svg class="h-6 w-6 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.21 1.434l-1.003.827c-.293.24-.438.613-.43.992a6.759 6.759 0 010 1.25c.008.378.138.75.43.99l1.005.828c.424.35.532.955.21 1.434l-1.298 2.247a1.125 1.125 0 01-1.369.49l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 01-.22.128c-.332.183-.582.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.063-.374-.313-.686-.645-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.075-.124l-1.217.456a1.125 1.125 0 01-1.37-.49l-1.296-2.247a1.125 1.125 0 01.21-1.434l1.004-.827c.292-.24.437-.613.43-.992a6.759 6.759 0 010-1.25c-.008-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.21-1.434l1.298-2.247c.303-.52.934-.686 1.37-.49l1.217.456c.355.133.75.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.213-1.28z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                            <h3 class="ml-2 text-2xl font-semibold text-black dark:text-black">Հիմնական կարգավորումներ</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            <div class="bg-indigo-50 p-4 rounded-lg border border-indigo-100">
                                <label for="title_en" class="block font-semibold text-xl text-indigo-900">Վերնագիր (English)</label>
                                <input id="title_en" class="block mt-1 w-full bg-white border-indigo-300 text-base text-gray-900 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="text" name="title[en]" value="{{ old('title.en') }}" required autofocus>
                                <x-input-error :messages="$errors->get('title.en')" class="mt-2" />
                            </div>
                            <div class="bg-indigo-50 p-4 rounded-lg border border-indigo-100">
                                <label for="subtitle_en" class="block font-semibold text-xl text-indigo-900">Բնորոշում (English)</label>
                                <input id="subtitle_en" class="block mt-1 w-full bg-white border-indigo-300 text-base text-gray-900 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="text" name="subtitle[en]" value="{{ old('subtitle.en') }}">
                                <x-input-error :messages="$errors->get('subtitle.en')" class="mt-2" />
                            </div>

                            <div class="bg-orange-50 p-4 rounded-lg border border-orange-100">
                                <label for="title_ru" class="block font-semibold text-xl text-orange-900">Վերնագիր (Russian)</label>
                                <input id="title_ru" class="block mt-1 w-full bg-white border-orange-300 text-base text-gray-900 focus:border-orange-500 focus:ring-orange-500 rounded-md shadow-sm" type="text" name="title[ru]" value="{{ old('title.ru') }}">
                                <x-input-error :messages="$errors->get('title.ru')" class="mt-2" />
                            </div>
                            <div class="bg-orange-50 p-4 rounded-lg border border-orange-100">
                                <label for="subtitle_ru" class="block font-semibold text-xl text-orange-900">Բնորոշում (Russian)</label>
                                <input id="subtitle_ru" class="block mt-1 w-full bg-white border-orange-300 text-base text-gray-900 focus:border-orange-500 focus:ring-orange-500 rounded-md shadow-sm" type="text" name="subtitle[ru]" value="{{ old('subtitle.ru') }}">
                                <x-input-error :messages="$errors->get('subtitle.ru')" class="mt-2" />
                            </div>

                            <div class="bg-red-50 p-4 rounded-lg border border-red-100">
                                <label for="title_hy" class="block font-semibold text-xl text-red-900">Վերնագիր (Armenian)</label>
                                <input id="title_hy" class="block mt-1 w-full bg-white border-red-300 text-base text-gray-900 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm" type="text" name="title[hy]" value="{{ old('title.hy') }}">
                                <x-input-error :messages="$errors->get('title.hy')" class="mt-2" />
                            </div>
                            <div class="bg-red-50 p-4 rounded-lg border border-red-100">
                                <label for="subtitle_hy" class="block font-semibold text-xl text-red-900">Բնորոշում (Armenian)</label>
                                <input id="subtitle_hy" class="block mt-1 w-full bg-white border-red-300 text-base text-gray-900 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm" type="text" name="subtitle[hy]" value="{{ old('subtitle.hy') }}">
                                <x-input-error :messages="$errors->get('subtitle.hy')" class="mt-2" />
                            </div>

                            <div class="md:col-span-2 mt-4">
                                <label for="slug" class="block font-semibold text-xl text-black dark:text-black">Հղում ( URL ADRESS)</label>
                                <input id="slug" class="block mt-1 w-full bg-white dark:bg-white border-gray-300 text-base text-gray-900 dark:text-gray-900 focus:border-gray-500 focus:ring-gray-500 rounded-md shadow-sm" type="text" name="slug" value="{{ old('slug') }}" required>
                                <x-input-error :messages="$errors->get('slug')" class="mt-2" />
                            </div>

                            <div>
                                <label for="logo" class="block font-semibold text-xl text-black dark:text-black">Վերբեռնել Լոգո</label>
                                <input id="logo" type="file" name="logo" class="block w-full mt-1 text-sm text-gray-700 dark:text-gray-700 border border-gray-300 rounded-md cursor-pointer bg-white dark:bg-white focus:outline-none file:mr-4 file:py-2 file:px-4 file:rounded-l-md file:border-0 file:font-medium file:bg-gray-200 file:text-gray-700 hover:file:bg-gray-300">
                                <x-input-error :messages="$errors->get('logo')" class="mt-2" />
                            </div>

                            <div>
                                <label for="background_image" class="block font-semibold text-xl text-black dark:text-black">Վերբեռնել ֆոնի նկար</label>
                                <input id="background_image" type="file" name="background_image" class="block w-full mt-1 text-sm text-gray-700 dark:text-gray-700 border border-gray-300 rounded-md cursor-pointer bg-white dark:bg-white focus:outline-none file:mr-4 file:py-2 file:px-4 file:rounded-l-md file:border-0 file:font-medium file:bg-gray-200 file:text-gray-700 hover:file:bg-gray-300">
                                <x-input-error :messages="$errors->get('background_image')" class="mt-2" />
                            </div>
                        </div>

                        <hr class="my-8 border-gray-200">
                        <div class="flex items-center border-b border-gray-200 pb-4 mb-6">
                            <svg class="h-6 w-6 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.53 16.122a3 3 0 00-5.78 1.128 2.25 2.25 0 01-2.43 2.43a4.5 4.5 0 008.636-3.558 3.001 3.001 0 00-1.426-5.78zM12 6.344a4.5 4.5 0 01.37-1.831c.126-.31.29-.603.49-.886a4.5 4.5 0 018.11 3.558 3.001 3.001 0 01-1.426 5.78z" /></svg>
                            <h3 class="ml-2 text-2xl font-semibold text-black dark:text-black">Դիզայնի կարգավորումներ</h3>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="brand_color" class="block font-semibold text-xl text-black dark:text-black">Հիմնական Գույն (Իկոններ, Տեքստեր, Լոգոյի Ֆոն)</label>
                                <input id="brand_color" type="color" name="brand_color" value="{{ old('brand_color', '#1E88E5') }}" class="block mt-1 w-full h-12 border-gray-300 dark:bg-white focus:border-gray-500 focus:ring-gray-500 rounded-md shadow-sm cursor-pointer">
                                <x-input-error :messages="$errors->get('brand_color')" class="mt-2" />
                            </div>

                            <div>
                                <label for="title_color" class="block font-semibold text-xl text-black dark:text-black">Վերնագրի Տեքստի Գույն</label>
                                <input id="title_color" type="color" name="title_color" value="{{ old('title_color', '#ffffff') }}" class="block mt-1 w-full h-12 border-gray-300 dark:bg-white focus:border-gray-500 focus:ring-gray-500 rounded-md shadow-sm cursor-pointer">
                                <x-input-error :messages="$errors->get('title_color')" class="mt-2" />
                            </div>


                            <div>
    <label for="icon_bg_color" class="block font-semibold text-xl text-black dark:text-black">Իկոնկաների ֆոնի գույն</label>
    <input id="icon_bg_color" type="color" name="icon_bg_color" value="{{ old('icon_bg_color', '#ffffff') }}" class="block mt-1 w-full h-12 border-gray-300 dark:bg-white focus:border-gray-500 focus:ring-gray-500 rounded-md shadow-sm cursor-pointer">
    <x-input-error :messages="$errors->get('icon_bg_color')" class="mt-2" />
</div>

<div>
    <label for="icon_bg_opacity" id="icon_bg_opacity_label" class="block font-semibold text-xl text-black dark:text-black">Իկոնկաների ֆոնի թափանցիկություն: {{ old('icon_bg_opacity', 1.0) }}</label>
    <input 
        id="icon_bg_opacity" 
        type="range" 
        name="icon_bg_opacity" 
        value="{{ old('icon_bg_opacity', 1.0) }}" 
        min="0" max="1" step="0.01" 
        class="block mt-4 w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-gray-600"
        oninput="updateIconOpacityLabel(this.value)">
    <x-input-error :messages="$errors->get('icon_bg_opacity')" class="mt-2" />
</div>

                            <div>
                                <label for="logo_bg_opacity" id="logo_bg_opacity_label" class="block font-semibold text-xl text-black dark:text-black">Լոգոյի ֆոնի թափանցիկություն: {{ old('logo_bg_opacity', 1.0) }}</label>
                                <input 
                                    id="logo_bg_opacity" 
                                    type="range" 
                                    name="logo_bg_opacity" 
                                    value="{{ old('logo_bg_opacity', 1.0) }}" 
                                    min="0" max="1" step="0.01" 
                                    class="block mt-4 w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-gray-600"
                                    oninput="updateOpacityLabel(this.value)">
                                <x-input-error :messages="$errors->get('logo_bg_opacity')" class="mt-2" />
                            </div>
                        </div>

                        <hr class="my-6 border-gray-200">
<h4 class="text-lg font-medium text-gray-900 mb-4">Ֆոնի մգացման կարգավորումներ (Overlay)</h4>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <label for="bg_overlay_color" class="block font-semibold text-xl text-black dark:text-black">Ֆոնի մգացման գույն</label>
        <input id="bg_overlay_color" type="color" name="bg_overlay_color" 
               value="{{ old('bg_overlay_color', $card->bg_overlay_color ?? '#151212') }}" 
               class="block mt-1 w-full h-12 border-gray-300 dark:bg-white focus:border-gray-500 focus:ring-gray-500 rounded-md shadow-sm cursor-pointer">
        <x-input-error :messages="$errors->get('bg_overlay_color')" class="mt-2" />
    </div>

    <div>
        <label for="bg_overlay_opacity" id="bg_overlay_opacity_label" class="block font-semibold text-xl text-black dark:text-black">
            Մգացման թափանցիկություն: {{ old('bg_overlay_opacity', $card->bg_overlay_opacity ?? 0.3) }}
        </label>
        <input 
            id="bg_overlay_opacity" 
            type="range" 
            name="bg_overlay_opacity" 
            value="{{ old('bg_overlay_opacity', $card->bg_overlay_opacity ?? 0.3) }}" 
            min="0" max="1" step="0.01" 
            class="block mt-4 w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-gray-600"
            oninput="document.getElementById('bg_overlay_opacity_label').innerText = 'Մգացման թափանցիկություն: ' + Number(this.value).toFixed(2)">
        <x-input-error :messages="$errors->get('bg_overlay_opacity')" class="mt-2" />
    </div>
</div>



<div class="bg-gray-800 p-6 rounded-2xl border border-gray-700/50 mb-8">
    <h3 class="text-lg font-semibold text-white mb-4 flex items-center gap-2">
        Share Buttons Style
    </h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <x-input-label for="share_btn_bg_color" :value="__('Share Button Background')" />
            <div class="flex items-center gap-3 mt-1">
                <input type="color" id="share_btn_bg_color_picker"
                    class="h-10 w-10 rounded cursor-pointer border-0 p-0"
                    value="#ffffff"
                    oninput="document.getElementById('share_btn_bg_color').value = this.value">
                <x-text-input id="share_btn_bg_color" class="block mt-1 w-full" type="text" name="share_btn_bg_color"
                    value="#ffffff" />
            </div>
        </div>

        <div>
            <x-input-label for="share_btn_bg_opacity" :value="__('Share Button Opacity (%)')" />
            <div class="flex items-center gap-4 mt-4">
                <input type="range" id="share_btn_bg_opacity_range" name="share_btn_bg_opacity" min="0" max="100" value="100"
                    class="w-full h-2 bg-gray-700 rounded-lg appearance-none cursor-pointer"
                    oninput="document.getElementById('share_btn_bg_opacity_val').innerText = this.value + '%'">
                <span id="share_btn_bg_opacity_val" class="text-white font-mono w-12">100%</span>
            </div>
        </div>
    </div>
</div>

                        <hr class="my-8 border-gray-200">
                        <div class="flex items-center border-b border-gray-200 pb-4 mb-6">
                            <svg class="h-6 w-6 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244" /></svg>
                            <h3 class="ml-2 text-2xl font-semibold text-black dark:text-black">Կոնտակտային Հղում URL ADRESներ</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            
                            @foreach ($availableLinks as $linkKey => $linkLabel)
                                <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm">
                                    <div class="flex items-center">
                                        <input type="checkbox" 
                                               name="links[{{ $linkKey }}][active]" 
                                               id="links-{{ $linkKey }}-active"
                                               class="h-4 w-4 rounded border-gray-400 dark:border-gray-500 text-gray-600 shadow-sm focus:ring-gray-500"
                                               {{ old('links.'.$linkKey.'.active') ? 'checked' : '' }}>
                                        
                                        <label for="links-{{ $linkKey }}-active" class="ml-2 block text-lg font-semibold text-gray-900 dark:text-gray-900">
                                            Ակտիվացնել {{ $linkLabel }}
                                        </label>
                                    </div>
                                    <div class="mt-3">
                                        <label for="links-{{ $linkKey }}-value" class="sr-only">{{ $linkLabel }} (Արժեք)</label>
                                        <input 
                                            id="links-{{ $linkKey }}-value" 
                                            class="block mt-1 w-full bg-white dark:bg-white border-gray-300 text-base text-gray-900 dark:text-gray-900 focus:border-gray-500 focus:ring-gray-500 rounded-md shadow-sm" 
                                            type="text" 
                                            name="links[{{ $linkKey }}][value]" 
                                            value="{{ old('links.'.$linkKey.'.value') }}" 
                                            placeholder="Լրացրեք արժեքը այստեղ...">
                                        <x-input-error :messages="$errors->get('links.'.$linkKey.'.value')" class="mt-2" />
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        
                        <div class="flex items-center justify-end mt-8 pt-8 border-t border-gray-200">
                            <button type="submit" class="inline-flex items-center justify-center px-10 py-4 bg-gray-800 border-2 border-gray-800 rounded-md font-bold text-lg text-white uppercase tracking-wide hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900 transition ease-in-out duration-150">
                                Պահպանել
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    
    <script>
        function updateOpacityLabel(value) {
            const formattedValue = Number(value).toFixed(2);
            const label = document.getElementById('logo_bg_opacity_label');
            if (label) {
                label.innerText = `Լոգոյի ֆոնի թափանցիկություն: ${formattedValue}`;
            }
        }
        document.addEventListener('DOMContentLoaded', function() {
            const slider = document.getElementById('logo_bg_opacity');
            if (slider) {
                updateOpacityLabel(slider.value);
            }
        });


    // Լոգոյի թափանցիկության ֆունկցիա
    function updateOpacityLabel(value) {
        const formattedValue = Number(value).toFixed(2);
        const label = document.getElementById('logo_bg_opacity_label');
        if (label) {
            label.innerText = `Լոգոյի ֆոնի թափանցիկություն: ${formattedValue}`;
        }
    }

    // Իկոնկաների թափանցիկության ֆունկցիա (ՆՈՐ)
    function updateIconOpacityLabel(value) {
        const formattedValue = Number(value).toFixed(2);
        const label = document.getElementById('icon_bg_opacity_label');
        if (label) {
            label.innerText = `Իկոնկաների ֆոնի թափանցիկություն: ${formattedValue}`;
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Initialization for Logo Opacity
        const slider = document.getElementById('logo_bg_opacity');
        if (slider) {
            updateOpacityLabel(slider.value);
        }

        // Initialization for Icon Opacity (ՆՈՐ)
        const iconSlider = document.getElementById('icon_bg_opacity');
        if (iconSlider) {
            updateIconOpacityLabel(iconSlider.value);
        }
    });
</script>
    </script>
</x-app-layout>