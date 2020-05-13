<?php


namespace App\Services;


class OrganizationService
{
    /**
     * collection obj for organization
     * @var
     */
    public $collectOrg;

    public function getFields(){
        return $this->collectOrg->first();
    }

    /**
     * find by org id
     * @param $orgId
     * @param array $columns
     * @return array|mixed
     * @throws \Exception
     */

    public function findById($orgId, $columns = []) {

        try {
            return $this->collectOrg->where('_id',$orgId)->pluck($columns)->toArray();

        } catch (\Exception $exception) {
            throw  new \Exception($exception->getMessage(),500);
        }

    }

    public function search($searchTerm, $value)
    {
        try {
            return ($this->collectOrg->filter(function ($item) use($searchTerm,$value) {
                if(array_key_exists($searchTerm, $item)):
                    if(is_array($item[$searchTerm]) && in_array($value,$item[$searchTerm])) :
                        return $item;
                    elseif($item[$searchTerm] == $value):
                        return $item;
                    endif;
                endif;
            }));
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }

}
