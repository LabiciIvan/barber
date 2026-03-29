<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateShopRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('shop'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'sometimes',
                'string',
                'max:255',
                Rule::unique('shops', 'name')->ignore($this->shop),
            ],

            'subdomain' => [
                'nullable',
                'string',
                'max:255',
                'alpha_dash',
                Rule::unique('shops', 'subdomain')->ignore($this->shop),
            ],

            'latitude' => [
                'sometimes',
                'numeric',
                'between:-90,90',
            ],

            'longitude' => [
                'sometimes',
                'numeric',
                'between:-180,180',
            ],

            'city' => [
                'sometimes',
                'string',
                'max:255',
            ],

            /*
            |--------------------------------------------------------------------------
            | Theme Settings (PARTIAL UPDATE ALLOWED)
            |--------------------------------------------------------------------------
            */
            'theme_settings' => [
                'sometimes',
                'nullable',
                'array',
            ],

            'theme_settings.logo' => [
                'sometimes',
                'string',
            ],

            'theme_settings.backgroundColor' => [
                'sometimes',
                'string',
            ],

            'theme_settings.bannerColor' => [
                'sometimes',
                'string',
            ],

            'theme_settings.textColor' => [
                'sometimes',
                'string',
            ],

            'theme_settings.specialOffer' => [
                'sometimes',
                'string',
                'max:255',
            ],

            'theme_settings.schedule' => [
                'sometimes',
                'array',
            ],

            'theme_settings.phoneContact' => [
                'sometimes',
                'string',
                'max:50',
            ],
        ];
    }
}
