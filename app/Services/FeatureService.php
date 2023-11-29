<?php

/**
* Created 11/17/2023 13:47:12
* Use this service to run all logic, then communicate with database through repository
*/

namespace App\Services;
use App\Repositories\FeatureRepository;

class FeatureService {
    private $repo;

    public function __construct(FeatureRepository $FeatureRepository)
    {
        $this->repo = $FeatureRepository;
    }

    /**
    * Function to get all list
    * @param array $data
    */
    public function list(array $data = [])
    {
        try {
            // get all list
            $where = null;
            if (!empty($data['name'])) {
                $name = $data['name'];
                $where = "name LIKE '%{$name}%'";
            }
            $select = 'id,name,description';
            $data = $this->repo->list($select, $where);

            return [
                'success' => true,
                'message' => 'Success',
                'data' => $data,
            ];
        } catch (\Throwable $th) {
            return buildErrorResponse($th);
        }
    }

    /**
    * Function to get detail data
    * @param string|int $id
    *
    * @return array
    */
    public function show($id)
    {
        try {
            // get detail data
            return [
                'data' => $this->repo->detail($id),
                'message' => 'Success',
                'success' => true,
            ];
        } catch(\Throwable $th) {
            return buildErrorResponse($th);
        }
    }

    /**
    * Function to store data
    * @param array $data
    */
    public function store(array $data)
    {
        try {
            // store data
            return [
                'data' => $this->repo->store($data),
                'message' => __('features.success_create_feature'),
                'success' => true,
            ];
        } catch (\Throwable $th) {
            return buildErrorResponse($th);
        }
    }

    /**
    * Function to update data
    * @param array $data
    * @param string|int $id
    *
    */
    public function update(array $data, string|int $id)
    {
        try {
            return [
                'success' => true,
                'data' => $this->repo->update($data, decodeID($id)),
                'message' => __('features.success_update_feature'),
            ];
        } catch (\Throwable $th) {
            return buildErrorResponse($th);
        }
    }

    /**
    * Function to delete data
    * @param string|int $id
    */
    public function delete(string|int $id)
    {
        try {
            return [
                'data' => $this->repo->delete(decodeID($id)),
                'message' => __('features.success_delete_feature'),
                'success' => true,
            ];
        } catch (\Throwable $th) {
            return buildErrorResponse($th);
        }
    }
}
