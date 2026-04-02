<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;

class ShopThemeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array|null
    {
        $theme = $this->theme_settings;

        Log::debug('----inShopTheme----');
        Log::debug($theme);
        Log::debug('----inShopTheme----');

        if (!$theme) {
            return null;
        }

        return [
            'logo' => $theme['logo'] ?? null,
            'backgroundColor' => $theme['backgroundColor'] ?? null,
            'bannerColor' => $theme['bannerColor'] ?? null,
            'textColor' => $theme['textColor'] ?? null,
            'specialOffer' => $theme['specialOffer'] ?? null,
            'schedule' => $theme['schedule'] ?? [],
            'phoneContact' => $theme['phoneContact'] ?? null,
        ];
    }
}
