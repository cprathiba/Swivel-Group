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
        $orgJsonPath = storage_path() . env('FILE_STORAGE') .self::ORGANIZATION .'.json';
        $service->collectOrg = collect(json_decode(file_get_contents($orgJsonPath), true));
        parent::__construct($service);
    }

}
