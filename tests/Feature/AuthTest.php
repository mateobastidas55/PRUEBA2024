<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;
    protected function setUp(): void
    {
        parent::setUp();

        // Elimina cualquier usuario con este email antes de ejecutar la prueba
        User::where('email', 'testing@testing.com')->delete();
    }

    public function test_create_user_in_hook(): void
    {
        $data = [
            'name' => 'testing',
            'email' => 'testing@testing.com',
            'password' => 't35t1ng'
        ];
        $response = $this->postJson(
            route('create.user'),
            $data,
            [
                'Authorization' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpc3MiOiJhcHAuYXZlb25saW5lLmNvIiwiZXhwIjoyMzc0MDAyMDYzLCJhdWQiOiIzZWJlNzljMTE3NTE2ZmM1ZWQ5ZTE0YmMxZDQ3YTU2OCIsImRhdGEiOiJqOGs1UWNTV2tzb21wQ08zbDQvRi9FNGJpU1d3Vk4rRUVSQlRTMlQybWdxMmt3eHpEOHN3UytPOTByUTdOVHRiUkdiYWQyenVMaFptR21MWUxHT0ovSXhVZTNLWERZWjBlRUpoYy9MV2htOFFUbDBiNUtkelNoQ3JrWFFGVzBsT1ZLaDZXSlBZajFHQktjeXB2blNsYXJXdGQyQUNMd2t4Y2JKbzRuSmZOak9LamFzL3pyMkI3WHdreDRDbXhNYkFiYWFvRXRwemhMWEw4VWUwMjdOZHAxM2JyQ3ZkRVA3cmFUb2UyVm81OU5NbW9JWnVteVZCQ2ZyTDVWTU01V1JiUncxNlBxblErRXBwYVFtWi9PcW0vOHdjYjRSVWF2WmtBTHU2bjhyKzQwcmJzMXY0RFl2cHloMXd4alZJKzRyZHRnYTJGaExlZVVOUW1xNndDVnNCNlVFbnBHYmRkNmJxYjFId29wRXk4aW9peHJWdDhFTjhScDQvem1JWHMwc0JxVWVSQ2JlRVgwbm5XOThxY0YzS2NXRkhDWkZENFNnZy81enExUjNJdG52TUdyTTNKYkFhSnlGK3pDaE1aZVJGTzRBdzl4NGlaYlRNT1ZRVnlMTFFBc0FSelovcmRXODNrZ0wyMlFMZnJEa0xXdmRRUWMyZ0ZNM2JwODN5M09kRStQZElnWkU2T0g0SEFxSU5MYmxvNWc9PSIsInVzdWFyaW8iOiJjYWd1aXJyZSIsInN0YXR1c0NsaWVudGUiOiIiLCJyb2wiOiJBZG1pbmlzdHJhZG9yIiwiaV9pZHVzdWFyaW8iOjI1MSwiZW50ZXJwcmlzZSI6MX0.i7Ail3vvpX3Cnr-kz3YkCTc34RLMpzIaKikSjYM3pz90SrB4Q2kbLovcszDAPBTUL9zKEBWbbHknlJcSBuz-c6bLs5NJAL9_9fXFsUcCiJLPBNrubglkf_CWGfk05ZQg3o7oqjb-MbpZ5WVScTwRivaTrypefKHni7ZT7t1ZezIOCUWUvOtGYyA0pFGhhV2sj_7MUL4i8nGKE_Qys61c2zveONG7ueezUT5KkXIfYaSIPobghn2g7_ME--rZl8dcCDQ8Om4xaZx_q5XF-GXD_cSdsrIjl_kdO17_-Fp22HWi4zS-BIWD-ORB26df_EOU1ID1FFy6RR4FMl7PtAB4Gw'
            ]
        );
        $response->assertStatus(201);
        $response->assertJsonStructure(
            [
                'success',
                'message',
                'user',
                'token',
            ]
        );
    }

    public function test_login_user_in_hook(): void
    {
        $data = [
            'name' => 'testing',
            'email' => 'testing@testing.com',
            'password' => Hash::make('t35t1ng')
        ];
        User::create($data);

        $response = $this->withBasicAuth('testing@testing.com', 't35t1ng')
            ->post(route('login'));
        $response->assertStatus(200);
        $response->assertJsonStructure(
            [
                'access_token',
                'token_type',
                'expires_in'
            ]
        );
    }

    public function test_logout_user_in_hook(): void
    {
        $data = [
            'name' => 'testing',
            'email' => 'testing@testing.com',
            'password' => Hash::make('t35t1ng')
        ];
        User::create($data);

        $responseAuth = $this->withBasicAuth('testing@testing.com', 't35t1ng')
            ->post(route('login'));

        $token = json_decode($responseAuth->getContent(), true)['access_token'];

        $response = $this->post(route('logout'), [], [
            'Authorization' => 'Bearer ' . $token
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(
            [
                'success',
                'message',
            ]
        );
    }

    public function test_refresh_user_in_hook(): void
    {
        $data = [
            'name' => 'testing',
            'email' => 'testing@testing.com',
            'password' => Hash::make('t35t1ng')
        ];
        User::create($data);

        $responseAuth = $this->withBasicAuth('testing@testing.com', 't35t1ng')
            ->post(route('login'));

        $token = json_decode($responseAuth->getContent(), true)['access_token'];

        $response = $this->post(route('refresh'), [], [
            'Authorization' => 'Bearer ' . $token
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(
            [
                'access_token',
                'token_type',
                'expires_in'
            ]
        );
    }

    public function test_me_user_in_hook(): void
    {
        $data = [
            'name' => 'testing',
            'email' => 'testing@testing.com',
            'password' => Hash::make('t35t1ng')
        ];
        User::create($data);

        $responseAuth = $this->withBasicAuth('testing@testing.com', 't35t1ng')
            ->post(route('login'));

        $token = json_decode($responseAuth->getContent(), true)['access_token'];

        $response = $this->post(route('me'), [], [
            'Authorization' => 'Bearer ' . $token
        ]);
        $response->assertStatus(200);
        $response->assertJsonStructure(
            [
                'id',
                'name',
                'email',
                'email_verified_at',
                'created_at',
                'updated_at',
            ]
        );
    }
}
