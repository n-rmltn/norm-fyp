<?php

namespace App\Http\Requests;

use App\Models\Product_Spec;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SpecUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'product_spec_cat' => ['required', 'string', 'max:255'],
            'product_spec_name' => ['required', 'string', 'max:255'],
        ];
    }
}
