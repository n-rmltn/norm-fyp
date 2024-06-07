<?php

namespace App\Http\Requests;

use App\Models\Compatibility;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompatibilityUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'motherboard' => ['required', 'string', 'max:255'],
            'cpu' => ['required', 'string', 'max:255'],
            'ram' => ['required', 'string', 'max:255'],
        ];
    }
}
