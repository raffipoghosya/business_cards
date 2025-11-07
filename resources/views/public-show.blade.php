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
            /* !!! ԱՎԵԼԱՑՎԱԾ Է. Առաջինը կիրառվում է սպիտակ կիսաթափանցիկ գույնի շերտը՝ rgba(255, 255, 255, 0.05) */
            background-image: linear-gradient(rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.3)), url('{{ $card->background_image_path ? Storage::url($card->background_image_path) : '' }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            /* Այս հատկությունը ապահովում է, որ ֆոնի նկարը ֆիքսված մնա էջը թերթելիս */
            background-attachment: fixed; 
            background-color: #1a1a1a; 
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
            /* !!! ՆՈՐ. Ավելացրել ենք ներքևի լրացուցիչ տարածք ֆիքսված կոճակի համար */
            padding-bottom: 100px; 
        }
        
        /* Ստեղծում է RGBA գույնը՝ ադմինից եկած HEX-ից և OPACITY-ից */
        @php
            list($r, $g, $b) = sscanf($card->brand_color, "#%02x%02x%02x");
            $logo_bg_rgba = "rgba($r, $g, $b, " . $card->logo_bg_opacity . ")";
            $brand_color = $card->brand_color;
        @endphp

        /* Custom scrollbar to match the dark theme */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-thumb { background-color: rgba(255, 255, 255, 0.2); border-radius: 4px; }
        
        /* Ֆիքսում ենք կլորավուն ֆոնի դիրքը և ձևը */
        .header-arc {
            height: 300px; /* Ֆիքսված բարձրություն */
            border-bottom-left-radius: 50%;
            border-bottom-right-radius: 50%;
            width: 100%;
            max-width: 400px; /* Համապատասխանեցնում է հիմնական բլոկին */
        }

        /* Ֆիքսում ենք լոգոյի բլոկի դիրքը */
        .logo-block {
            padding-top: 8vh; /* Բարձրացված լոգո */
        }
        
        /* Ոճավորում նկարի ֆիդբեքի դաշտերի համար */
        .feedback-input {
            background-color: #2c2c2c; /* Մուգ մոխրագույն ֆոն */
            color: white; /* Սպիտակ տեքստ */
            border: none; /* Առանց եզրագծի */
            padding: 1rem;
            width: 100%;
            border-radius: 0.5rem;
            outline: none;
        }
        
        /* Placeholder-ի գույնը փոխելու համար */
        .feedback-input::placeholder {
            color: #b3b3b3; /* Բաց մոխրագույն placeholder */
        }
        
        /* !!! ՆՈՐ. Ֆիքսված կոճակի կոնտեյներ */
        .fixed-contact-button {
            position: fixed;
            bottom: 0; 
            left: 50%; /* Տեղափոխում ենք կենտրոն */
            transform: translateX(-50%); /* Հետ ենք քաշում կիսով չափ՝ ճիշտ կենտրոնացման համար */
            z-index: 50; /* Ապահովում ենք, որ լինի բոլորի վերևում */
            width: 100%;
            max-width: 400px; /* Համապատասխանեցնում ենք հիմնական բովանդակության լայնությանը */
            padding: 1rem;
            /* background: linear-gradient(to top, #1a1a1a 80%, rgba(26, 26, 26, 0.8) 100%); Թույլ թափանցիկ ֆոն՝ սահուն անցում ապահովելու համար */
        }
    </style>
</head>
<body>

    <div class="relative w-full max-w-md mx-auto pb-20"> 
        <div class="absolute top-0 left-0 right-0 z-0 w-full h-[360px] shadow-2xl" 
             style="background-color: {{ $logo_bg_rgba }};border-bottom-left-radius: 40%; border-bottom-right-radius: 40%;">
        </div>

    
       

        <div class="relative z-10 flex flex-col items-center logo-block">
            <div class="logo-background w-48 h-48 rounded-full flex items-center justify-center shadow-lg bg-white p-2">
                
                @if ($card->logo_path)
                    <img src="{{ Storage::url($card->logo_path) }}" alt="{{ $card->title }} Logo" class="w-full h-full object-contain rounded-full">
                @else
                    <h1 class="text-3xl font-bold text-center text-gray-800 px-4">{{ $card->title }}</h1>
                @endif
            </div>
            
            <h2 class="mt-4 text-xl font-bold text-white tracking-widest">{{ $card->title }}</h2>
        </div>

        <div class="relative z-10 w-full px-6 pt-28 mb-12">

            <div class="w-full grid grid-cols-4 gap-4">
                
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
                                case 'website':   $iconClass = 'fa-solid fa-globe'; break;
                                case 'whatsapp':  $iconClass = 'fa-brands fa-whatsapp'; $href = 'https://wa.me/' . preg_replace('/[^0-9]/', '', $link['value']); $label = 'WhatsApp'; break;
                                case 'viber':     $iconClass = 'fa-brands fa-viber'; $href = 'viber://chat?number=' . preg_replace('/[^0-9]/', '', $link['value']); $label = 'Viber'; break;
                                case 'facebook':  $iconClass = 'fa-brands fa-facebook-f'; break;
                                case 'messenger': $iconClass = 'fa-brands fa-facebook-messenger'; break;
                                case 'instagram': $iconClass = 'fa-brands fa-instagram'; break;
                                case 'location':  $iconClass = 'fa-solid fa-location-dot'; break;
                            }
                        @endphp

                        <a href="{{ $href }}" target="_blank" class="flex flex-col items-center text-decoration-none group">
                            <div class="w-16 h-16 rounded-2xl flex items-center justify-center mb-2 transition-transform duration-200 shadow-xl" 
                                 style="background-color: {{ $brand_color }};">
                                <i class="{{ $iconClass }} text-white text-3xl"></i>
                            </div>
                            <span class="text-sm font-bold mt-1" style="color: {{ $brand_color }};">
                                {{ $label }}
                            </span>
                        </a>
                    @endforeach
                @endif
            </div>

        </div>

        <div class="relative z-10 w-full px-6 pt-8">
            
            <h2 class="text-2xl font-bold text-white text-center mb-6 tracking-widest">FEEDBACK</h2>

            <form action="#" method="POST" class="space-y-4">
                <input type="text" name="first_name" placeholder="First name" class="feedback-input h-14" required>
                <input type="text" name="last_name" placeholder="Last name" class="feedback-input h-14" required>
                <input type="email" name="email" placeholder="E-mail" class="feedback-input h-14" required>
                <input type="tel" name="phone" placeholder="+XXXXXXXXXX" class="feedback-input h-14">
                <textarea name="message" placeholder="Message" rows="5" class="feedback-input resize-none"></textarea>
                
                <div class="text-center pt-4">
                    <button type="submit" class="inline-flex items-center justify-center py-3 px-12 rounded-full text-center text-white font-bold uppercase shadow-2xl transition-transform duration-200 hover:scale-[1.02]"
                           style="background-color: {{ $brand_color }};">
                        send
                    </button>
                </div>
            </form>

            <div class="my-10 border-t border-gray-700"></div> 
            
            <h2 class="text-2xl font-bold text-white text-center mb-6 tracking-widest">SHARE MY CARD</h2>
            
            <div class="flex justify-center space-x-4 pb-12">
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank" class="w-14 h-14 bg-[#2c2c2c] rounded-lg flex items-center justify-center hover:bg-gray-700 transition-colors duration-200">
                    <i class="fa-brands fa-facebook-f text-white text-xl"></i>
                </a>
                <a href="https://wa.me/?text=Check%20out%20my%20digital%20card:%20{{ url()->current() }}" target="_blank" class="w-14 h-14 bg-[#2c2c2c] rounded-lg flex items-center justify-center hover:bg-gray-700 transition-colors duration-200">
                    <i class="fa-brands fa-whatsapp text-white text-xl"></i>
                </a>
                <a href="#" class="w-14 h-14 bg-[#2c2c2c] rounded-lg flex items-center justify-center hover:bg-gray-700 transition-colors duration-200">
                    <i class="fa-brands fa-instagram text-white text-xl"></i>
                </a>
                <a href="sms:?body=Check%20out%20my%20digital%20card:%20{{ url()->current() }}" class="w-14 h-14 bg-[#2c2c2c] rounded-lg flex items-center justify-center hover:bg-gray-700 transition-colors duration-200">
                    <i class="fa-solid fa-comment-dots text-white text-xl"></i>
                </a>
            </div>
            
        </div>
    </div>
    
    <div class="fixed-contact-button text-center">
        <a href="#" class="inline-flex items-center justify-center w-full max-w-xs py-3 px-6 rounded-full text-center text-white font-bold uppercase shadow-2xl transition-transform duration-200 hover:scale-[1.02]"
           style="background-color: {{ $brand_color }};">
            <i class="fa-solid fa-user-plus mr-2"></i>
            Add me to the contact list
        </a>
    </div>
    </body>
</html>