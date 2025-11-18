<?php
use Illuminate\Support\Facades\Storage;

// Օգնող ֆունկցիա՝ տվյալները ապահով ստանալու համար
$getTranslation = function($field, $lang = 'en') {
    if (is_array($field)) {
        return $field[$lang] ?? $field['en'] ?? '';
    }
    return $field;
};

// Սկզբնական արժեքները (Default English)
$titleEn = $getTranslation($card->title, 'en');
$subtitleEn = $getTranslation($card->subtitle, 'en');

// Պատրաստում ենք JSON տվյալները JavaScript-ի համար
$jsData = [
    'titles' => is_array($card->title) ? $card->title : ['en' => $card->title, 'ru' => $card->title, 'hy' => $card->title],
    'subtitles' => is_array($card->subtitle) ? $card->subtitle : ['en' => '', 'ru' => '', 'hy' => ''],
];

$vcard_link = generateVCard($card);
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<link href="https://fonts.cdnfonts.com/css/gunterz" rel="stylesheet">
<link href="https://fonts.cdnfonts.com/css/mardoto" rel="stylesheet">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $titleEn }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @php
            list($r, $g, $b) = sscanf($card->brand_color, "#%02x%02x%02x");
            $logo_bg_rgba = "rgba($r, $g, $b, " . $card->logo_bg_opacity . ")";
            $brand_color = $card->brand_color;
        @endphp

        body {
            background-image: linear-gradient(rgba(42, 34, 34, 0.3), rgba(27, 25, 25, 0.3)), url('{{ $card->background_image_path ? Storage::url($card->background_image_path) : '' }}');
            background-color: #1a1a1a;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: 'Mardoto', Arial, sans-serif; /* Added Mardoto as default for consistent look */
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
            padding-bottom: 100px;
        }

        .contact-btn {
            background-color: {{ $brand_color }};
            color: white;
            padding: 1rem 1.5rem;
            border-radius: 9999px;
            font-weight: 700;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.4);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .share-icon-img {
            width: 28px;
            height: 28px;
            filter: brightness(0) invert(1);
        }
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-thumb { background-color: rgba(255, 255, 255, 0.2); border-radius: 4px; }

        .logo-block { padding-top: 8vh; }

        .icon-img {
            width: 32px;
            height: 32px;
            filter: brightness(0) invert(1);
        }
        .fixed-contact-button {
            position: fixed;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            z-index: 50;
            width: 100%;
            max-width: 400px;
            padding: 1rem;
        }
        
        /* --- Փոփոխված մասը (Նոր Լեզվի կոճակներ) --- */
        .lang-switcher-container {
            display: flex;
            align-items: center;
            gap: 20px; /* Հեռավորություն լեզուների միջև */
        }

        .lang-btn {
            background: transparent;
            border: none;
            padding: 0;
            font-family: 'Mardoto', sans-serif; /* Կամ ձեր նախընտրած ֆոնտը */
            font-weight: 600;
            font-size: 18px; 
            text-transform: uppercase;
            color: #7a7a7a; /* Մոխրագույն՝ ոչ ակտիվ վիճակի համար */
            cursor: pointer;
            position: relative;
            transition: color 0.3s ease;
            letter-spacing: 0.5px;
        }

        .lang-btn:hover {
            color: #bfbfbf;
        }

        /* Ակտիվ վիճակ */
        .lang-btn.active {
            color: #ffffff; /* Սպիտակ գույն */
            font-weight: 700;
        }

        /* Սպիտակ գիծը ներքևում */
        .lang-btn.active::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -8px; /* Գծի հեռավորությունը տեքստից */
            width: 100%;
            height: 2px; /* Գծի հաստությունը */
            background-color: #ffffff;
        }
    </style>
    <style>
@font-face {
    font-family: 'Gunterz';
    src: url('/fonts/Gunterz-Regular.ttf') format('truetype');
    font-weight: 400;
    font-style: normal;
}

@font-face {
    font-family: 'Gunterz';
    src: url('/fonts/Gunterz-Bold.ttf') format('truetype');
    font-weight: 700;
    font-style: normal;
}
</style>

</head>
<body>

    <div class="relative w-full max-w-md mx-auto pb-20">
        <div class="absolute top-0 left-0 right-0 z-0 w-full h-[400px] shadow-2xl"
             style="background-color: {{ $logo_bg_rgba }};border-bottom-left-radius: 35%; border-bottom-right-radius: 35%;">
        </div>

        <div class="absolute top-6 left-6 z-50">
            <img src="{{ asset('iconsvg/logo.png') }}" alt="Brand Logo" class="h-8 w-auto opacity-90 drop-shadow-md">
        </div>

        <div class="absolute top-7 right-8 z-50 lang-switcher-container">
            <button onclick="switchLanguage('hy')" id="btn-hy" class="lang-btn">ՀԱՅ</button>
            <button onclick="switchLanguage('ru')" id="btn-ru" class="lang-btn">РУ</button>
            <button onclick="switchLanguage('en')" id="btn-en" class="lang-btn active">EN</button>
        </div>

        <div class="relative z-10 flex flex-col items-center logo-block">
            <div class="logo-background w-48 h-48 rounded-full flex items-center justify-center shadow-lg bg-white p-2">
                @if ($card->logo_path)
                    <img src="{{ Storage::url($card->logo_path) }}" alt="Logo" class="w-full h-full object-contain rounded-full">
                @else
                    <h1 id="logo-text" class="text-3xl font-bold text-center text-gray-800 px-4">{{ $titleEn }}</h1>
                @endif
            </div>

            <div class="text-center mt-4 w-full">
            <h1 id="display-title"
    class="text-2xl tracking-tight drop-shadow-lg font-bold"
    style="color: {{ $card->title_color ?? '#ffffff' }};
           font-weight: 700;
           display: inline-block;
           max-width: 14ch;
           white-space: normal;
           overflow-wrap: break-word;
           word-break: keep-all;
           line-height: 0.9;">
    {{ $titleEn }}
</h1>

<p id="display-subtitle" 
   class="text-sm font-medium tracking-wide px-6"
   style="color: #ffffff; opacity: 0.8; font-family: 'Mardoto', sans-serif;
          letter-spacing: 0px; margin-top: 0.01rem;
                    max-width: 25ch;    
                       margin-left: 27%;

">
    {{ $subtitleEn }}
</p>



            </div>
            </div>

        <div class="relative z-10 w-full px-6 pt-16 mb-12">

            <div class="w-full grid grid-cols-4 gap-4">

                @if ($card->links)
                    @foreach ($card->links as $link)
                        @php
                            $iconContent = '';
                            $href = $link['value'];
                            $label = $link['label'];
                            $iconPath = 'iconsvg/';

                            switch ($link['key']) {
                                case 'phone':
                                    $iconContent = '<img src="' . asset($iconPath . 'telephone.svg') . '" alt="Phone Icon" class="icon-img">';
                                    $href = 'tel:' . $link['value'];
                                    break;
                                case 'sms':
                                    $iconContent = '<img src="' . asset($iconPath . 'sms.svg') . '" alt="SMS Icon" class="icon-img">';
                                    $href = 'sms:' . $link['value'];
                                    break;
                                case 'mail':
                                    $iconContent = '<img src="' . asset($iconPath . 'mail.svg') . '" alt="Mail Icon" class="icon-img">';
                                    $href = 'mailto:' . $link['value'];
                                    break;
                                case 'website':
                                    $iconContent = '<img src="' . asset($iconPath . 'web.svg') . '" alt="Website Icon" class="icon-img">';
                                    break;
                                case 'whatsapp':
                                    $iconContent = '<img src="' . asset($iconPath . 'whatsapp.svg') . '" alt="WhatsApp Icon" class="icon-img">';
                                    $href = 'https://wa.me/' . preg_replace('/[^0-9]/', '', $link['value']);
                                    break;
                                case 'viber':
                                    $iconContent = '<img src="' . asset($iconPath . 'viber.svg') . '" alt="Viber Icon" class="icon-img">';
                                    $href = 'viber://chat?number=' . preg_replace('/[^0-9]/', '', $link['value']);
                                    break;
                                case 'facebook':
                                    $iconContent = '<img src="' . asset($iconPath . 'facebook.svg') . '" alt="Facebook Icon" class="icon-img">';
                                    break;
                                case 'messenger':
                                    $iconContent = '<img src="' . asset($iconPath . 'massenger.svg') . '" alt="Messenger Icon" class="icon-img">';
                                    break;
                                case 'instagram':
                                    $iconContent = '<img src="' . asset($iconPath . 'instagram.svg') . '" alt="Instagram Icon" class="icon-img">';
                                    break;
                                    case 'youtube':
                                    $iconContent = '<img src="' . asset($iconPath . 'youtube.svg') . '" class="icon-img">';
                                    break;
                                case 'telegram':
                                    $iconContent = '<img src="' . asset($iconPath . 'telegram.svg') . '" class="icon-img">';
                                    $val = $link['value'];
                                    if (!str_starts_with($val, 'http')) {
                                        $val = 'https://t.me/' . str_replace('@', '', $val);
                                    }
                                    $href = $val;
                                    break;
                                case 'tiktok':
                                    $iconContent = '<img src="' . asset($iconPath . 'tiktok.svg') . '" class="icon-img">';
                                    break;
                                case 'location':
                                    $iconContent = '<img src="' . asset($iconPath . 'location.svg') . '" alt="Location Icon" class="icon-img">';
                                    break;
                                default:
                                    $iconContent = '<img src="' . asset($iconPath . 'default-link.svg') . '" alt="Link Icon" class="icon-img">';
                            }
                        @endphp

                        <a href="{{ $href }}" target="_blank" class="flex flex-col items-center text-decoration-none group">
                            <div class="w-16 h-16 rounded-2xl flex items-center justify-center mb-2 transition-transform duration-200 shadow-xl hover:scale-110"
                                 style="background-color: {{ $brand_color }};">
                                {!! $iconContent !!}
                            </div>
                            <span class="text-xs font-bold mt-1 text-center truncate w-full" style="color: {{ $brand_color }};">
                                {{ $label }}
                            </span>
                        </a>
                    @endforeach
                @endif
            </div>

            <div class="my-10 border-t border-gray-700/50"></div>

            <h2 class="text-xl font-bold text-white text-center mb-6 tracking-widest opacity-90">SHARE MY CARD</h2>

            <div class="flex justify-center space-x-4 pb-12">
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank" class="w-12 h-12 bg-[#2c2c2c] rounded-lg flex items-center justify-center hover:bg-gray-700 transition-colors duration-200 shadow-lg">
                    <img src="{{ asset('iconsvg/facebook.svg') }}" alt="Facebook" class="share-icon-img w-6 h-6">
                </a>
                <a href="https://wa.me/?text=Check%20out%20my%20digital%20card:%20{{ url()->current() }}" target="_blank" class="w-12 h-12 bg-[#2c2c2c] rounded-lg flex items-center justify-center hover:bg-gray-700 transition-colors duration-200 shadow-lg">
                    <img src="{{ asset('iconsvg/whatsapp.svg') }}" alt="WhatsApp" class="share-icon-img w-6 h-6">
                </a>
                <a href="https://www.instagram.com/share?url={{ urlencode(url()->current()) }}" target="_blank" class="w-12 h-12 bg-[#2c2c2c] rounded-lg flex items-center justify-center hover:bg-gray-700 transition-colors duration-200 shadow-lg">
                    <img src="{{ asset('iconsvg/instagram.svg') }}" alt="Instagram" class="share-icon-img w-6 h-6">
                </a>
                <a href="sms:?body=Check%20out%20my%20digital%20card:%20{{ url()->current() }}" class="w-12 h-12 bg-[#2c2c2c] rounded-lg flex items-center justify-center hover:bg-gray-700 transition-colors duration-200 shadow-lg">
                    <img src="{{ asset('iconsvg/sms.svg') }}" alt="SMS" class="share-icon-img w-6 h-6">
                </a>
            </div>
        </div>
    </div>

    <div class="fixed-contact-button text-center">
        <a href="{{ $vcard_link }}" download="{{ $card->slug }}.vcf"
           class="inline-flex items-center justify-center w-full max-w-[280px] contact-btn transition-transform duration-200 hover:scale-[1.02] active:scale-[0.98]">
            <img src="{{ asset('iconsvg/add-user.svg') }}" alt="Add User" class="icon-img mr-3 w-5 h-5">
            <span class="text-base uppercase tracking-wide font-bold">
                Save Contact
            </span>
        </a>
    </div>

    <script>
        // Տվյալները ստանում ենք PHP-ից
        const cardData = {
            titles: @json($jsData['titles']),
            subtitles: @json($jsData['subtitles'])
        };

        function switchLanguage(lang) {
            // 1. Թարմացնում ենք տեքստերը
            const title = cardData.titles[lang] || cardData.titles['en'] || '';
            const subtitle = cardData.subtitles[lang] || cardData.subtitles['en'] || '';

            const titleEl = document.getElementById('display-title');
            const subtitleEl = document.getElementById('display-subtitle');
            const logoTextEl = document.getElementById('logo-text');

            if(titleEl) titleEl.innerText = title;
            if(subtitleEl) subtitleEl.innerText = subtitle;
            if(logoTextEl) logoTextEl.innerText = title;

            // 2. Թարմացնում ենք կոճակների ոճերը
            document.querySelectorAll('.lang-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            
            const activeBtn = document.getElementById('btn-' + lang);
            if(activeBtn) {
                activeBtn.classList.add('active');
            }
        }
    </script>
</body>
</html>