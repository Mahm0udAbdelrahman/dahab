<?php
namespace App\Http\Requests\Dashboard\Setting;

use Illuminate\Foundation\Http\FormRequest;

class StoreSettingRequest extends FormRequest
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
            'name'       => ['nullable', 'array'],
            'name.en'    => ['nullable', 'string', 'max:255'],
            'name.ar'    => ['nullable', 'string', 'max:255'],
            'address'    => ['nullable', 'array'],
            'address.en' => ['nullable', 'string'],
            'address.ar' => ['nullable', 'string'],
            'email'      => ['nullable', 'string', 'max:255'],
            'phone'      => ['nullable', 'string', 'max:255'],
            'logo'       => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'favicon'    => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'facebook'   => ['nullable', 'string', 'max:255'],
            'instagram'  => ['nullable', 'string', 'max:255'],
            'tiktok'     => ['nullable', 'string', 'max:255'],
            'whatsapp'   => ['nullable', 'string', 'max:255'],

        ];
    }

}
