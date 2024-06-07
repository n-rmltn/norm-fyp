<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'product_name' => ['required', 'string', 'max:255'],
            'product_brand_id' => ['required', 'string', 'max:255'],
            'product_category_id' => ['required', 'string', 'max:255'],
            'product_spec_id' => ['required', 'string', 'max:255'],
            'product_description' => ['required', 'string', 'max:65535'],
            'product_base_price' => ['required', 'string', 'max:255'],
            'product_quantity' => ['required', 'string', 'max:255'],
            'product_availability' => ['required', 'string', 'max:255'],
        ];
    }
}
