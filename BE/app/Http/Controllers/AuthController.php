<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Services\Authentication;

class AuthController extends Controller
{
    public function login(LoginRequest $request, Authentication $authenticationService)
    {
        $data = $request->validated();

        return $authenticationService->login($data);
    }

    public function register(RegisterRequest $request, Authentication $authenticationService)
    {
        $data = $request->validated();

        return $authenticationService->register($data);
    }
}
