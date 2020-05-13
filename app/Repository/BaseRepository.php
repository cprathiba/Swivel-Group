<?php


namespace App\Repository;

class BaseRepository implements BaseRepositoryInterface
{

    /**
     * @var
     */
    public $service;

    /**
     * BaseRepository constructor.
     * @param $service
     */

    public function __construct($service)
    {
        $this->service = $service;
    }

    /**
     * base repository , get fields as array
     * @return mixed
     */

    public function getFields(){
        return $this->service->getFields();
    }

    /**
     * base repository , find by id
     * @param $id
     * @param array $columns
     * @return mixed
     */

    public function findById($id, $columns = [])
    {
         return $this->service->findById($id, $columns);
    }

    /**
     * base repository , search
     * @param $searchTerm
     * @param $value
     * @return mixed
     */

    public function search($searchTerm, $value)
    {
        return $this->service->search($searchTerm, $value);
    }

}
