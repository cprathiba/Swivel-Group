<?php


namespace App\Repository;


interface TicketRepositoryInterface
{

    public function findAllSubmittedTicketsByUserId($userId, $columns = []);

    public function findAllAssigneeTicketsByUserId($userId, $columns = []);

    public function findAllTicketsByOrgId($orgId, $columns = []);

}
