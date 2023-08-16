<?php

namespace Tests\Feature;

use Database\Factories\UserRequestFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserResourceTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    public function test_empty_list(): void
    {
        $response = $this->get('/users');

        $response->assertStatus(200);
    }

    public function test_full_list(): void
    {
        // create a record first
        $user = UserRequestFactory::create();

        $response = $this->post('/users', $user);
        $response->assertStatus(200);
        $this->assertIsInt($response->json('id'));

        // make sure the list is not empty
        $response = $this->get('/users');

        $response->assertStatus(200);
        $response->assertJsonCount(1);
    }

    public function test_create(): void
    {
        $user = UserRequestFactory::create();

        $response = $this->post('/users', $user);

        $response->assertStatus(200);

        $this->assertIsInt($response->json('id'));
    }

    public function test_show(): void
    {
        // create a record first
        $user = UserRequestFactory::create();

        $response = $this->post('/users', $user);
        $response->assertStatus(200);
        $this->assertIsInt($response->json('id'));

        // show the record
        $response = $this->get('/users/'.$response->json('id'), $user);
        $response->assertStatus(200);
        $this->assertEquals($user['name'], $response->json('name'));
        $this->assertEquals($user['email'], $response->json('email'));
    }

    public function test_update(): void
    {
        // create a record first
        $user = UserRequestFactory::create();

        $response = $this->post('/users', $user);
        $response->assertStatus(200);
        $this->assertIsInt($response->json('id'));

        // update that record
        $user = UserRequestFactory::update();

        $response = $this->put('/users/'.$response->json('id'), $user);
        $response->assertStatus(200);
        $this->assertEquals($user['name'], $response->json('name'));
        $this->assertEquals($user['email'], $response->json('email'));
    }

    public function test_destroy(): void
    {
        // create a record first
        $user = UserRequestFactory::create();

        $response = $this->post('/users', $user);
        $response->assertStatus(200);
        $this->assertIsInt($response->json('id'));

        // delete that record
        $response = $this->delete('/users/'.$response->json('id'), $user);
        $response->assertStatus(200);
    }
}
