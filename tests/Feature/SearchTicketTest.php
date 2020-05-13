<?php

namespace Tests\Feature;

use App\Repository\TicketRepository;
use App\Services\TicketService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SearchTicketTest extends TestCase
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
     * Unit testing for ticket service
     * @throws \Exception
     */

    public function testTicketService()
    {
        $ticket = new TicketRepository(new TicketService());

        $this->assertEmpty($ticket->findById(12000));

        $this->assertNotEmpty($ticket->search('subject','A Problem in Malawi'));

        $this->assertNotEmpty($ticket->findAllTicketsByOrgId(104));

        $this->assertEmpty($ticket->findAllAssigneeTicketsByUserId(104));

    }

}
