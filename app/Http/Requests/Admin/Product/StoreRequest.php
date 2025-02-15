<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name"                  => ['required', 'string', 'max:255'],
            "slug"                  => ['required', 'string', 'max:255'],
            "category_id"           => ['required', 'string'],
            "brand_id"              => ['required', 'string'],
            "short_description"     => ['nullable', 'string', 'max:255'],
            "description"           => ['nullable', 'string'],
            "price"                 => ['required', 'numeric'],
            "sale_price"            => ['required', 'numeric'],
            "quantity"              => ['nullable', 'numeric'],
            "SKU"                   => ['required', 'string', 'max:255'],

            "image"                 => ['required', 'file', 'mimes:png,jpg,jpeg,webp'],
            "images.*"              => ['nullable', 'file', 'mimes:png,jpg,jpeg,webp'],
        ];
    }
}
