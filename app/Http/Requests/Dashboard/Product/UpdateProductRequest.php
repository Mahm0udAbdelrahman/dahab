<?php
namespace App\Http\Requests\Dashboard\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'name'             => ['nullable', 'array'],
            'name.en'          => ['nullable', 'string', 'max:255'],
            'name.ar'          => ['nullable', 'string', 'max:255'],
            'description'      => ['nullable', 'array'],
            'description.en'   => ['nullable', 'string'],
            'description.ar'   => ['nullable', 'string'],
            'price'            => ['nullable', 'string', 'max:255'],
            'discounted_price' => ['nullable', 'string', 'max:255'],
            'amount_in_stock'  => ['nullable', 'string', 'max:255'],
            'images'           => ['nullable', 'array'],
            'images.*'         => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'status'           => ['nullable', 'in:used,new'],
            'category_id'      => ['required', 'exists:categories,id'],
            'is_active'        => ['nullable', 'boolean'],
        ];
    }
}
