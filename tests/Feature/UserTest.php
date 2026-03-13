<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_users(): void
    {

        $this->seed();

        $json = [
            'first_name' => 'Jane',
            'last_name'  => 'Doe',
            'email'      => 'janedoe@gmail.com',
            'phone'      => '1231231234'
        ];

        $response = $this->postJson('/api/users', $json);
        $response->assertStatus(CREATED);
        $this->assertDatabaseHas('users', $json);
    }

    public function test_create_exception_422_users(): void
    {

        $this->seed();

        $json = [
            'first_name' => 'Jane',
            'email'      => 'janedoe@gmail.com',
            'phone'      => '1231231234'
        ];

        $response = $this->postJson('/api/users', $json);
        $response->assertStatus(INVALID_DATA);
    }

    public function test_update_users(): void
    {

        $this->seed();

        $json = [
            'first_name' => 'Jane',
            'last_name'  => 'Doe',
            'email'      => 'janedoe@gmail.com',
            'phone'      => '1231231234'
        ];

        $this->postJson('/api/users', $json);

        $updatedJson = [
            'first_name' => 'Jane',
            'last_name'  => 'Doe',
            'email'      => 'janedoe@gmail.com',
            'phone'      => '9879879876'
        ];

        $response = $this->putJson('/api/users/11', $updatedJson);
        $response->assertStatus(CREATED);
        $this->assertDatabaseHas('users', $updatedJson);
    }

    public function test_update_exception_404_users(): void
    {

        $this->seed();

        $json = [
            'first_name' => 'Jane',
            'last_name'  => 'Doe',
            'email'      => 'janedoe@gmail.com',
            'phone'      => '1231231234'
        ];

        $this->postJson('/api/users', $json);

        $updatedJson = [
            'first_name' => 'Jane',
            'last_name'  => 'Doe',
            'email'      => 'something@gmail.com',
            'phone'      => '9879879876'
        ];

        $response = $this->putJson('/api/users/5000', $updatedJson);
        $response->assertStatus(NOT_FOUND);
    }
}
