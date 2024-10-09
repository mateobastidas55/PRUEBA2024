<?php

namespace App\Repositories\App\UserRepositories;

use App\Models\NotificationMethods;
use App\Models\User;
use App\Repositories\Interfaces\UserInterfaces\UserInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserInterface
{
    public function index(): array
    {
        return [];
    }

    public function store(array $request): array
    {
        $idMethodNotification = new NotificationMethods();
        // dd($request);
        $fillable = [
            'name' => $request['name'],
            'birt_day' => Carbon::createFromFormat('d/m/Y', $request['birthday'])->format('Y-m-d'),
            'id_notification_method_favorite' => $idMethodNotification::where('notification_method_name', $request['notification'])->first()->id,
            'id_rol' => 1,
            'email' => $request['email'],
            'phone' => $request['phone'],
            'password' => Hash::make($request['password']),
        ];
        $user = User::create($fillable);

        $user->sendEmailVerificationNotification();

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
