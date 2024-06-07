<?php

namespace App\Http\Requests;

use App\Models\Product_Brand;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BrandUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'product_brand_name' => ['required', 'string', 'max:255'],
        ];
    }
}
