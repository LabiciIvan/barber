<?php

namespace App\Http\Services;

use App\Models\User;
use App\Http\Traits\CustomResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class Authentication {

    use CustomResponse;

    public function login(array $data)
    {
        try {
            if (!Auth::attempt([
                'email'    => $data['email'],
                'password' => $data['password'],
            ])) {
                throw ValidationException::withMessages([
                    'email' => ['The provided credentials are incorrect.'],
                ]);
            }

            /** @var App/Models/User $user */
            $user = Auth::user();

            $user->tokens()->delete();

            $token = $user->createToken('api');

            return $this->success([
                'token' => $token->plainTextToken,
            ]);

        } catch (ValidationException $e) {
            return $this->errorResponse($e->getMessage(), $e->errors());
        } catch (\Throwable $e) {
            return $this->error(CustomResponse::SYSTEM_ERROR);
        }
    }

    public function register(array $data)
    {
        try {

            $user = User::create([
                'name'      => $data['name'],
                'email'     => $data['email'],
                'password'  => Hash::make($data['password']),
                'phone'     => $data['phone'],
                'role'      => $data['role'],
            ]);

            $token = $user->createToken('api-token');

            return $this->success([
                'token' => $token->plainTextToken,
            ]);

        } catch (\Throwable $e) {
            return $this->error(CustomResponse::SYSTEM_ERROR);
        }
    }

    public function logout() {
        
    }
}