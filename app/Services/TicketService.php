<?php


namespace App\Services;


use Illuminate\Support\Facades\Storage;

class TicketService
{

    /**
     * collection obj for tickets
     * @var \Illuminate\Support\Collection
     */

    public $collectTickets;

    /**
     * path to storage
     * @var
     */

    protected $folderPath;

    /**
     * get first array to fetch the searchable fields
     * @return mixed
     */

    public function getFields()
    {
        return $this->collectTickets->first();
    }

    /**
     * find All Submitted Tickets By User Id
     * @param $userId
     * @param array $columns
     * @return array
     * @throws \Exception
     */

    public function findAllSubmittedTicketsByUserId($userId, $columns = []) {
        try {
            return $this->collectTickets->where('submitter_id', $userId)->pluck($columns)->toArray();
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }

    }

    /**
     * find All Assignee Tickets By User Id
     * @param $userId
     * @param array $columns
     * @return array
     * @throws \Exception
     */

    public function findAllAssigneeTicketsByUserId($userId, $columns = []) {
        try {
            return $this->collectTickets->where('assignee_id', $userId)->pluck($columns)->toArray();
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }

    }

    /**
     * search entity
     * @param $term
     * @param $value
     * @return \Illuminate\Support\Collection
     * @throws \Exception
     */

    public function search($term, $value)
    {
        try {
            return $this->collectTickets->filter(function ($item) use ($term, $value) {
                if (array_key_exists($term, $item)):
                    if (is_array($item[$term]) && in_array($value, $item[$term])) :
                        return $item;
                    elseif (is_string($item[$term]) && $item[$term] == $value):
                        return $item;
                    endif;
                endif;

            });
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }

    /**
     * find by ticket id
     * @param $id
     * @param array $columns
     * @return mixed
     * @throws \Exception
     */

    public function findById($id, $columns = [])
    {
        try {

            return $this->collectTickets->where('_id',$id)->pluck($columns)->toArray();

        } catch (\Exception $exception) {
            throw  new \Exception($exception->getMessage());
        }
    }

    /**
     * find all ticket by org id
     * @param $orgId
     * @param null $columns
     * @return array
     * @throws \Exception
     */

    public function findAllTicketsByOrgId($orgId, $columns = []) {
        try {
            return $this->collectTickets->where('organization_id',$orgId)->pluck($columns)->toArray();
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }

    }

}
