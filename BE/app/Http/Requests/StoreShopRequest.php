<?php

namespace App\Http\Requests;

use App\Models\Shop;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreShopRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', Shop::class);
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
                'required',
                'string',
                'max:255',
                Rule::unique('shops', 'name'),
            ],

            'slug' => [
                'required',
                'string',
                'max:255',
                'alpha_dash',
                Rule::unique('shops', 'slug'),
            ],

            'subdomain' => [
                'nullable',
                'string',
                'max:255',
                'alpha_dash',
                Rule::unique('shops', 'subdomain'),
            ],

            'latitude' => [
                'required',
                'numeric',
                'between:-90,90',
            ],

            'longitude' => [
                'required',
                'numeric',
                'between:-180,180',
            ],

            'city' => [
                'required',
                'string',
                'max:255',
            ],

            /*
            |--------------------------------------------------------------------------
            | Theme Settings
            |--------------------------------------------------------------------------
            */
            'theme_settings' => [
                'nullable',
                'array',
            ],

            'theme_settings.logo' => [
                'required_with:theme_settings',
                'string',
            ],

            'theme_settings.backgroundColor' => [
                'required_with:theme_settings',
                'string',
            ],

            'theme_settings.bannerColor' => [
                'required_with:theme_settings',
                'string',
            ],

            'theme_settings.textColor' => [
                'required_with:theme_settings',
                'string',
            ],

            'theme_settings.specialOffer' => [
                'required_with:theme_settings',
                'string',
                'max:255',
            ],

            'theme_settings.schedule' => [
                'required_with:theme_settings',
                'array',
            ],

            'theme_settings.phoneContact' => [
                'required_with:theme_settings',
                'string',
                'max:50',
            ],
        ];
    }
}
