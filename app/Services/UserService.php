<?php

/**
* Created 11/18/2023 09:38:37
* Use this service to run all logic, then communicate with database through repository
*/

namespace App\Services;
use App\Repositories\UserRepository;

class UserService {
    private $repo;

    public function __construct(UserRepository $UserRepository)
    {
        $this->repo = $UserRepository;
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
    public function show(string|int $id)
    {
        try {
            // get detail data
            $select = "username,email,address,phone,phone_code,avatar,status,id";
            $detail = $this->repo->detail($id, $select);

            // get total amount
            $amounts = collect($detail->wallets)->pluck('saldo')->sum();
            $detail['total_saldo'] = $amounts;

            return [
                'data' => $detail,
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

    public function initWallet(array $data)
    {
        try {
            return [
                'success' => true,
                'data' => $data,
                // 'data' => $this->repo->initWallet($data),
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
