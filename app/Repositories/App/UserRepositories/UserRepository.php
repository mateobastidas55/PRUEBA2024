<?php

namespace App\Repositories\App\UserRepositories;

use App\Models\User;
use App\Repositories\Interfaces\UserInterfaces\UserInterface;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserInterface
{
    public function index(): array
    {
        return [];
    }

    public function store(array $request): array
    {
        $fillable = [
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ];
        $user = User::create($fillable);

        $credentials = [
            'email'    => $request['email'],
            'password' => $request['password']
        ];

        $token = auth()->attempt($credentials);
        return [
            'success' => true,
            'message' => 'Usuario registrado exitosamente.',
            'user' => $user,
            'token' => $token
        ];
    }

    public function show(int $id, array $request): array
    {
        return [];
    }

    public function update(int $id, array $request): array
    {
        return [];
    }

    public function destroy(int $id): array
    {
        return [];
    }
}
