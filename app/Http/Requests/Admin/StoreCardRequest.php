<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreCardRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Թույլատրում ենք բոլոր մուտք գործած օգտատերերին
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        // Սա օգնում է խմբագրելիս (edit) slug-ի ունիկալության ստուգմանը
        $cardId = $this->route('card') ? $this->route('card')->id : null;

        return [
            // *** ՈՒՂՂՈՒՄԸ ԱՅՍՏԵՂ Է ***
            // Հիմնական (Բազմալեզու)
            'title' => 'required|array', // 'title'-ն այժմ զանգված է
            'title.en' => 'required|string|max:255', // Անգլերենը պարտադիր է
            'title.ru' => 'nullable|string|max:255',
            'title.hy' => 'nullable|string|max:255',
            
            'subtitle' => 'nullable|array', // 'subtitle'-ը զանգված է, բայց ոչ պարտադիր
            'subtitle.en' => 'nullable|string|max:255',
            'subtitle.ru' => 'nullable|string|max:255',
            'subtitle.hy' => 'nullable|string|max:255',

            // Slug (մնում է նույնը)
            'slug' => 'required|string|alpha_dash|max:255|unique:business_cards,slug,' . $cardId,
            
            // Ֆայլեր
            'logo' => 'nullable|image|max:2048', // max 2MB
            'background_image' => 'nullable|image|max:4096', // max 4MB

            // Դիզայն
            'brand_color' => 'required|string|size:7|starts_with:#',
            'logo_bg_opacity' => 'required|numeric|min:0|max:1', 
            
            // Հղումներ
            'links' => 'nullable|array', 
            'links.*.value' => 'nullable|string|max:500', 
            'links.*.active' => 'nullable|string',
        ];
    }
}