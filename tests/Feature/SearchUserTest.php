<?php

namespace Tests\Feature;

use App\Repository\UserRepository;
use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SearchUserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * Unit testing for user service
     * @throws \Exception
     */

    public function testUserService()
    {

        $user = new UserRepository(new UserService());

        $this->assertEmpty($user->findById(12000));

        $this->assertNotEmpty($user->search('name','Harper Sandoval'));

        $this->assertNotEmpty($user->findAllUsersByOrgId(104));

    }
}
