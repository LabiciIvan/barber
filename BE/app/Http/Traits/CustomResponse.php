<?php

namespace App\Http\Traits;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

trait CustomResponse {

    public const SYSTEM_ERROR = 'System error, try again later.';

    public function success(array|Collection|JsonResource|null $data): array {
        return [
            'status' => 'success',
            'data'   => $data
        ];
    }

    public function failed(?string $message): array {
        return [
            'status' => 'failed',
            'data'   => $message
        ];
    }

    public function error(?string $message): array {
        return [
            'status' => 'error',
            'data'   => $message
        ];
    }

}