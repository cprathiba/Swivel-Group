<?php


namespace App\Repository;

use App\Services\OrganizationService;

class OrganizationRepository extends BaseRepository implements OrganizationRepositoryInterface
{

    public const ORGANIZATION = 'organization';

    /**
     * OrganizationRepository constructor.
     * @param OrganizationService $service
     */

    public function __construct(OrganizationService $service)
    {
        $orgJsonPath = storage_path() . self::STORAGE_PATH .self::ORGANIZATION .'.json';
        $service->collectOrg = collect(json_decode(file_get_contents($orgJsonPath), true));
        parent::__construct($service);
    }

}
