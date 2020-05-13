<?php


namespace App\Repository;


interface UserRepositoryInterface
{
    public function findAllUsersByOrgId($orgId, $columns = []);
}
