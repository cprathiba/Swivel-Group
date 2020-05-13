<?php


namespace App\Repository;


use App\Services\TicketService;

class TicketRepository extends BaseRepository implements TicketRepositoryInterface
{

    /**
     * const variable for ticket entity
     */

    public const TICKET = 'ticket';

    /**
     * TicketRepository constructor.
     * @param TicketService $service
     */

    public function __construct(TicketService $service)
    {
        $orgJsonPath = storage_path() . env('FILE_STORAGE') .self::TICKET .'.json';
        $service->collectTickets = collect(json_decode(file_get_contents($orgJsonPath), true));
        parent::__construct($service);
    }

    /**
     * @param $userId
     * @param array $columns
     * @return mixed
     */

    public function findAllAssigneeTicketsByUserId($userId, $columns = [])
    {
        return $this->service->findAllAssigneeTicketsByUserId($userId, $columns);
    }

    /**
     * @param $userId
     * @param array $columns
     * @return mixed
     */

    public function findAllSubmittedTicketsByUserId($userId, $columns = [])
    {
        return $this->service->findAllSubmittedTicketsByUserId($userId, $columns);
    }

    /**
     * @param $orgId
     * @param array $columns
     * @return mixed
     */

    public function findAllTicketsByOrgId($orgId, $columns = [])
    {
        return $this->service->findAllTicketsByOrgId($orgId, $columns);
    }

}
