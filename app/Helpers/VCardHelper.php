<?php

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\BusinessCard;

if (!function_exists('generateVCard')) {
    function generateVCard(BusinessCard $card): string {
        $vcard = "BEGIN:VCARD\r\n";
        $vcard .= "VERSION:3.0\r\n";

        // *** ՈՒՂՂՈՒՄ ***
        // Ստուգում ենք՝ title-ը զանգված է, թե ոչ։
        // Եթե զանգված է, վերցնում ենք 'en' (անգլերեն) տարբերակը, կամ առաջինը, որ կա։
        $displayTitle = $card->title;
        if (is_array($card->title)) {
            $displayTitle = $card->title['en'] ?? reset($card->title) ?? 'Digital Card';
        }

        $vcard .= "FN:" . $displayTitle . "\r\n";
        $vcard .= "ORG:" . $displayTitle . "\r\n";

        if ($card->links) {
            // links-ը արդեն array է (casts-ի շնորհիվ), կարիք չկա json_decode անելու
            $links = is_array($card->links) ? $card->links : json_decode($card->links, true);

            if (is_array($links)) {
                foreach ($links as $link) {
                    // Ստուգում ենք, որ array լինի (ապահովության համար)
                    if (!is_array($link)) continue;

                    $value = $link['value'] ?? '';
                    $key = $link['key'] ?? '';

                    switch ($key) {
                        case 'phone':
                            $vcard .= "TEL;TYPE=WORK,VOICE:" . $value . "\r\n";
                            break;
                        case 'sms':
                            // vCard-ը ստանդարտ SMS դաշտ չունի, սովորաբար պահվում է որպես TEL կամ NOTE
                            $vcard .= "TEL;TYPE=MSG:" . $value . "\r\n";
                            break;
                        case 'mail':
                            $vcard .= "EMAIL;TYPE=PREF,INTERNET:" . $value . "\r\n";
                            break;
                        case 'website':
                            $vcard .= "URL;TYPE=Website:" . $value . "\r\n";
                            break;
                        case 'location':
                            $vcard .= "ADR;TYPE=WORK:;;" . $value . "\r\n";
                            break;
                        case 'whatsapp':
                            $vcard .= "X-SOCIALPROFILE;type=whatsapp:" . $value . "\r\n";
                            break;
                        case 'facebook':
                            $vcard .= "X-SOCIALPROFILE;type=facebook:" . $value . "\r\n";
                            break;
                        case 'instagram':
                            $vcard .= "X-SOCIALPROFILE;type=instagram:" . $value . "\r\n";
                            break;
                            case 'youtube':
                                $vcard .= "X-SOCIALPROFILE;type=youtube:" . $value . "\r\n";
                                break;
                            case 'telegram':
                                $vcard .= "X-SOCIALPROFILE;type=telegram:" . $value . "\r\n";
                                break;
                            case 'tiktok':
                                $vcard .= "X-SOCIALPROFILE;type=tiktok:" . $value . "\r\n";
                                break;                        default:
                            if (!empty($value)) {
                                $vcard .= "URL;TYPE=" . ucfirst($key) . ":" . $value . "\r\n";
                            }
                            break;
                    }
                }
            }
        }

        // Ավելացնում ենք նկարը (PHOTO), եթե կա
        if ($card->logo_path) {
             // vCard 3.0-ը աջակցում է ուղիղ URL (PHOTO;VALUE=URI:...)
             // կամ Base64 (PHOTO;ENCODING=b;TYPE=JPEG:...)
             // Ամենահեշտը URL տարբերակն է, եթե ֆայլը հասանելի է դրսից
             $photoUrl = Storage::url($card->logo_path);
             // Լիարժեք URL ստանալու համար (եթե Storage::url-ը հարաբերական է տալիս)
             if (!Str::startsWith($photoUrl, ['http://', 'https://'])) {
                 $photoUrl = asset($photoUrl);
             }
             
             $vcard .= "PHOTO;VALUE=URI:" . $photoUrl . "\r\n";
        }

        $vcard .= "END:VCARD\r\n";

        return $vcard;
    }
}