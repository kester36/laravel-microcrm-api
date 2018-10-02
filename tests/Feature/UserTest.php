<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    public function testsCreateUser()
    {
        $payload = [
            'first_name' => 'Linus',
            'last_name' => 'Torvalds',
            'email' => 'linus@torvalds.tux',
        ];

        $this->json('POST', '/api/users', $payload)
            ->assertStatus(201)
            ->assertJson([
                'id' => 1,
                'first_name' => 'Linus',
                'last_name' => 'Torvalds',
                'email' => 'linus@torvalds.tux',
            ]);
    }

    public function testsUpdateUser()
    {
        $user = factory(User::class)->create([
            'first_name' => 'John1',
            'last_name' => 'Doe1',
            'email' => 'john1@doe1.fake',
        ]);

        $payload = [
            'first_name' => 'John2',
            'last_name' => 'Doe2',
            'email' => 'john2@doe2.fake',
        ];

        $this->json('PUT', '/api/users/' . $user->id, $payload)
            ->assertStatus(200)
            ->assertJson([
                'id' => 1,
                'first_name' => 'John2',
                'last_name' => 'Doe2',
                'email' => 'john2@doe2.fake',
            ]);
    }

    public function testsDeleteUser()
    {
        $user = factory(User::class)->create();

        $this->json('DELETE', '/api/users/' . $user->id, [])
            ->assertStatus(204);
    }

    public function testsGetAllUsers()
    {
        $user1 = [
            'first_name' => 'Bill',
            'last_name' => 'Gates',
            'email' => 'bill@gates.ms',
        ];

        $user2 = [
            'first_name' => 'Steve',
            'last_name' => 'Jobs',
            'email' => 'steve@jobs.imac',
        ];

        factory(User::class)->create($user1);
        factory(User::class)->create($user2);

        $this->json('GET', '/api/users', [])
            ->assertStatus(200)
            ->assertJson([$user1, $user2])
            ->assertJsonStructure([
                '*' => ['id', 'first_name', 'last_name', 'email', 'created_at', 'updated_at'],
            ]);
    }


    public function testsGetUser()
    {
        $user = factory(User::class)->create([
            'first_name' => 'Richard',
            'last_name' => 'Stallman',
            'email' => 'richard@stallman.gnu',
        ]);

        $this->json('GET', '/api/users/' . $user->id, [])
            ->assertStatus(200)
            ->assertJson([
                'id' => $user->id,
                'first_name' => 'Richard',
                'last_name' => 'Stallman',
                'email' => 'richard@stallman.gnu',
            ])
            ->assertJsonStructure(['id', 'first_name', 'last_name', 'email', 'created_at', 'updated_at']);
    }
}
