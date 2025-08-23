<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateUserRequest;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Traits\ApiResponse;

class AuthController extends Controller
{
    use ApiResponse;
    public function register(CreateUserRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);

        $user = User::query()->create($data);
        $user->sendEmailVerificationNotification();

        return $this->success($user, 'User registered successfully.', 201);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $data = $request->validated();

        $user = User::query()->where('email', $data['email'])->first();

        if (empty($user) || $user->email_verified_at === null) {
            return $this->error([], 'email is not verified.', 401);
        }

        if (empty($user) || ! Hash::check($data['password'], $user->password)) {
            return $this->error([], 'The provided credentials are incorrect.', 401);
        }

        $token = $user->createToken('auth_token', ['*'], now()->addDay())->plainTextToken;

        return response()->json(['access_token' => $token]);
    }

    public function user(Request $request) : JsonResponse
    {
        if($data = new UserResource($request->user()))
        {
            return $this->success($data);
        }
        return $this->error([], 'User not found', 401);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();
        
        return $this->success([], 'Logged out successfully.', 200);
    }
}