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
            // Հիմնական
            'title' => 'required|string|max:255',
            'slug' => 'required|string|alpha_dash|max:255|unique:business_cards,slug,' . $cardId,
            
            // Ֆայլեր
            'logo' => 'nullable|image|max:2048', // max 2MB
            'background_image' => 'nullable|image|max:4096', // max 4MB

            // Դիզայն (մեկ գույն + թափանցիկություն)
            'brand_color' => 'required|string|size:7|starts_with:#',
            'logo_bg_opacity' => 'required|numeric|min:0|max:1', 
            
            // Հղումներ
            'links' => 'nullable|array', 
            'links.*.value' => 'nullable|string|max:500', 
            'links.*.active' => 'nullable|string', // Checkbox-ը գալիս է 'on' կամ null
        ];
    }
}