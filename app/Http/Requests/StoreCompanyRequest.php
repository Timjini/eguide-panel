<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyRequest extends FormRequest
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
            'legal_name'     => ['required', 'string', 'max:255'],
            'primary_email'  => ['required', 'email'],
            'address'        => ['required', 'string'],
            'post_code'      => ['required', 'string'],
            'city'           => ['required', 'string'],
            'country'        => ['required', 'string'],

            'contact_person' => ['nullable', 'string'],
            'website'        => ['nullable', 'url'],
            'phone_1'        => ['nullable', 'string'],
            'phone_2'        => ['nullable', 'string'],
            'district'       => ['nullable', 'string'],
            'vat_number'     => ['nullable', 'string'],
        ];
    }
}
