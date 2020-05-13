<?php


namespace App\Services;


use App\Repository\UserRepository;

class UserService
{

    /**
     * user collection
     * @var \Illuminate\Support\Collection
     */
    public $collectUsers;

    public function getFields(){
        return $this->collectUsers->first();
    }

    public function search($term, $value) {

        try {
            return ($this->collectUsers->filter(function ($item) use($term,$value) {
                if(array_key_exists($term, $item)):
                    if(is_array($item[$term]) && in_array($value,$item[$term])) :
                        return $item;
                    elseif($item[$term] == $value):
                        return $item;
                    endif;
                endif;
            }));
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }

    }

    /**
     * find by user id
     * @param $userId
     * @param array $columns
     * @return \Illuminate\Support\Collection|mixed
     * @throws \Exception
     */

    public function findById($userId, $columns = []) {
        try {
            return $this->collectUsers->where('_id',$userId)->pluck($columns)->toArray();

        } catch (\Exception $exception) {
            throw  new \Exception($exception->getMessage(),500);
        }
    }

    /**
     * get all users by org id
     * @param $orgId
     * @param array $columns
     * @return array
     * @throws \Exception
     */

    public function findAllUsersByOrgId($orgId, $columns = [])
    {
        try {

            return $this->collectUsers->where('organization_id',$orgId)->pluck($columns)->toArray();

        } catch (\Exception $exception) {
            throw  new \Exception($exception->getMessage(),500);
        }
    }

}
