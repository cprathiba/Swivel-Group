<?php


namespace App\Repository;

interface BaseRepositoryInterface
{

    public function getFields();

    public function search($searchTerm, $value);

    public function findById($id, $columns = []);

}
