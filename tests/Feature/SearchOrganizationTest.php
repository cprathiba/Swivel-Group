<?php

namespace Tests\Feature;

use App\Repository\OrganizationRepository;
use App\Services\OrganizationService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SearchOrganizationTest extends TestCase
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
     * unit testing for organization service
     * @throws \Exception
     */

    public function testOrganizationService()
    {
        $org = new OrganizationRepository(new OrganizationService());

        $this->assertEmpty($org->findById(500));

        $this->assertNotEmpty($org->search('name','Xylar'));

    }
}
