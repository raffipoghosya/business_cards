<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $card->title }}</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
    <style>
        /* Հիմնական ոճավորում՝ Figma-ին համապատասխան */
        body {
            /* Կիրառում ենք վերբեռնված ֆոնի նկարը */
            background-image: url('{{ $card->background_image_path ? Storage::url($card->background_image_path) : '' }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed; /* Ֆոնը մնում է անշարժ */
            
            /* Եթե նկար չկա, ցույց ենք տալիս մուգ գույն */
            background-color: #1a1a1a; 
            font-family: Arial, sans-serif;
        }

        /* * Սա ստեղծում է rgba գույն՝ ադմինից եկած hex գույնից և թափանցիկությունից
         * Օրինակ՝ #FF0000 և 0.5 -> rgba(255, 0, 0, 0.5)
         */
        @php
            list($r, $g, $b) = sscanf($card->logo_bg_color, "#%02x%02x%02x");
            $logo_bg_rgba = "rgba($r, $g, $b, " . $card->logo_bg_opacity . ")";
            
            /* Գույն իկոնների և տեքստի համար (օգտագործողի սահմանած) */
            $brand_color = $card->brand_color;
        @endphp
    </style>
</head>
<body class="min-h-screen">

    <div class="relative z-10 w-full max-w-md mx-auto">
        
        <div class="flex justify-center pt-16">
            <div class="logo-background w-48 h-48 rounded-full flex items-center justify-center shadow-lg" 
                 style="background-color: {{ $logo_bg_rgba }};">
                
                @if ($card->logo_path)
                    <img src="{{ Storage::url($card->logo_path) }}" alt="{{ $card->title }} Logo" class="w-40 h-40 object-contain rounded-full">
                @else
                    <h1 class="text-3xl font-bold text-center text-white px-4">{{ $card->title }}</h1>
                @endif
            </div>
        </div>

        <div class="w-full grid grid-cols-4 gap-4 mb-10 px-6 mt-36">
            
            @if ($card->links)
                @foreach ($card->links as $link)
                    @php
                        $iconClass = '';
                        $href = $link['value'];
                        $label = $link['label'];

                        // Սահմանում ենք ճիշտ իկոնը և հղումը
                        switch ($link['key']) {
                            case 'phone':     $iconClass = 'fa-solid fa-phone'; $href = 'tel:' . $link['value']; $label = 'Phone'; break;
                            case 'sms':       $iconClass = 'fa-solid fa-message'; $href = 'sms:' . $link['value']; $label = 'SMS'; break;
                            case 'mail':      $iconClass = 'fa-solid fa-envelope'; $href = 'mailto:' . $link['value']; $label = 'Mail'; break;
                            case 'website':   $iconClass = 'fa-solid fa-globe'; $label = 'Website'; break;
                            case 'whatsapp':  $iconClass = 'fa-brands fa-whatsapp'; $href = 'https://wa.me/' . preg_replace('/[^0-9]/', '', $link['value']); $label = 'WhatsApp'; break;
                            case 'viber':     $iconClass = 'fa-brands fa-viber'; $href = 'viber://chat?number=' . preg_replace('/[^0-9]/', '', $link['value']); $label = 'Viber'; break;
                            case 'facebook':  $iconClass = 'fa-brands fa-facebook-f'; $label = 'Facebook'; break;
                            case 'messenger': $iconClass = 'fa-brands fa-facebook-messenger'; $label = 'Messenger'; break;
                            case 'instagram': $iconClass = 'fa-brands fa-instagram'; $label = 'Instagram'; break;
                            case 'location':  $iconClass = 'fa-solid fa-location-dot'; $label = 'Location'; break;
                        }
                    @endphp

                    <a href="{{ $href }}" target="_blank" class="flex flex-col items-center text-decoration-none group">
                        <div class="w-16 h-16 rounded-2xl flex items-center justify-center mb-2 transition-transform duration-200 group-hover:scale-110" 
                             style="background-color: {{ $brand_color }};">
                            <i class="{{ $iconClass }} text-white text-3xl"></i>
                        </div>
                        <span class="text-sm font-medium" style="color: {{ $brand_color }};">
                            {{ $label }}
                        </span>
                    </a>
                @endforeach
            @endif
        </div>

        <div class="text-center px-6 pb-12">
            <a href="#" class="inline-flex items-center justify-center w-full max-w-xs py-3 px-6 rounded-full text-center text-white font-bold uppercase shadow-lg transition-transform duration-200 hover:scale-105"
               style="background-color: {{ $brand_color }};">
                <i class="fa-solid fa-user-plus mr-2"></i>
                Add me to the contact
            </a>
        </div>
    </div>


    <div class="absolute top-0 left-0 right-0 z-0 w-full h-[360px] rounded-b-[40%] shadow-2xl" 
         style="background-color: {{ $logo_bg_rgba }};">
    </div>

</body>
</html>