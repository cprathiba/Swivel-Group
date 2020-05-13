<?php


namespace App\Repository;

use App\Services\UserService;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{

    /**
     * constant variable for users
     */
    public const USER = 'user';

    public function __construct(UserService $service)
    {
        $orgJsonPath = storage_path() . self::STORAGE_PATH .self::USER .'.json';
        $service->collectUsers = collect(json_decode(file_get_contents($orgJsonPath), true));
        parent::__construct($service);
    }

    /**
     * @param $orgId
     * @param array $columns
     * @return mixed
     */

    public function findAllUsersByOrgId($orgId, $columns = [])
    {
        return $this->service->findAllUsersByOrgId($orgId, $columns);
    }
}
