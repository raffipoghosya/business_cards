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
            background-image: linear-gradient(rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.3)), url('{{ $card->background_image_path ? Storage::url($card->background_image_path) : '' }}');
            background-color: #1a1a1a;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: Arial, sans-serif;
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
        
        /* --- Փոփոխված մասը (Լեզվի կոճակներ) --- */
        .lang-btn {
            transition: all 0.3s ease;
            color: rgba(255, 255, 255, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.3);
            background-color: rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(4px);
        }
        .lang-btn:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
        }
        .lang-btn.active {
            background-color: rgba(255, 255, 255, 0.9);
            color: #000;
            border-color: white;
            font-weight: 800;
        }
    </style>
</head>
<body>

    <div class="relative w-full max-w-md mx-auto pb-20">
        <div class="absolute top-0 left-0 right-0 z-0 w-full h-[360px] shadow-2xl"
             style="background-color: {{ $logo_bg_rgba }};border-bottom-left-radius: 40%; border-bottom-right-radius: 40%;">
        </div>

        <div class="absolute top-6 left-6 z-50">
            <img src="{{ asset('iconsvg/logo.png') }}" alt="Brand Logo" class="h-8 w-auto opacity-90 drop-shadow-md">
        </div>

        <div class="absolute top-6 right-6 z-50 flex space-x-2">
            <button onclick="switchLanguage('hy')" id="btn-hy" class="lang-btn text-[10px] font-bold px-3 py-1.5 rounded-full uppercase tracking-wider">ՀԱՅ</button>
            <button onclick="switchLanguage('ru')" id="btn-ru" class="lang-btn text-[10px] font-bold px-3 py-1.5 rounded-full uppercase tracking-wider">RU</button>
            <button onclick="switchLanguage('en')" id="btn-en" class="lang-btn active text-[10px] font-bold px-3 py-1.5 rounded-full uppercase tracking-wider">EN</button>
        </div>

        <div class="relative z-10 flex flex-col items-center logo-block">
            <div class="logo-background w-48 h-48 rounded-full flex items-center justify-center shadow-lg bg-white p-2">
                @if ($card->logo_path)
                    <img src="{{ Storage::url($card->logo_path) }}" alt="Logo" class="w-full h-full object-contain rounded-full">
                @else
                    <h1 id="logo-text" class="text-3xl font-bold text-center text-gray-800 px-4">{{ $titleEn }}</h1>
                @endif
            </div>

            <h2 id="display-title" class="mt-5 text-2xl font-bold text-white tracking-widest text-center drop-shadow-md px-4">
                {{ $titleEn }}
            </h2>
            
            <p id="display-subtitle" class="mt-2 text-base text-white/90 tracking-wide text-center font-medium drop-shadow-sm px-6">
                {{ $subtitleEn }}
            </p>
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