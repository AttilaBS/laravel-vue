<?php

namespace App\Http\Requests;

use App\Rules\NamePattern;
use Illuminate\Foundation\Http\FormRequest;

final class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string,array|string|float|integer>
     */
    public function rules(): array
    {

        return [
            'name' => ['required', 'string', 'between:3,80', new NamePattern],
            'description' => 'nullable|string|between:5,255',
            'price' => 'required|decimal:2',
            'stock_quantity' => 'required|integer|between:1,9999',
            'search' => 'nullable|string|between:1,255',
        ];
    }
}
