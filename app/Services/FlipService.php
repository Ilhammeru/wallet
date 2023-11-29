<?php

/**
* Created 11/18/2023 04:05:22
* Use this service to run all logic, then communicate with database through repository
*/

namespace App\Services;
use App\Repositories\FlipRepository;

class FlipService {
    private $repo;

    public function __construct(FlipRepository $FlipRepository)
    {
        $this->repo = $FlipRepository;
    }

    /**
    * Function to get all list
    * @param array $data
    */
    public function list(array $data = [])
    {
        try {
            // get all list
            $data = $this->repo->list();

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
                'message' => 'Success',
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
                'data' => $this->repo->update($data, $id),
                'message' => 'Success'
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
                'data' => $this->repo->delete($id),
                'message' => 'Success',
                'success' => true,
            ];
        } catch (\Throwable $th) {
            return buildErrorResponse($th);
        }
    }
}
