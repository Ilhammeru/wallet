<?php

/**
* Created 11/18/2023 11:13:59
* Use this service to run all logic, then communicate with database through repository
*/

namespace App\Services;
use App\Repositories\WalletCategoryRepository;
use DateTime;

class WalletCategoryService {
    private $repo;

    public function __construct(WalletCategoryRepository $WalletCategoryRepository)
    {
        $this->repo = $WalletCategoryRepository;
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
            $store = $this->repo->store($data);

            return [
                'data' => $store,
                'message' => __('wallet.success_create_wallet_category'),
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
            // TODO: validate relation

            return [
                'success' => true,
                'data' => $this->repo->update($data, decodeID($id)),
                'message' => __('wallet.success_update_wallet_category')
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
            // TODO: Validate relation
            return [
                'data' => $this->repo->delete(decodeID($id)),
                'message' => __('wallet.success_delete_wallet_category'),
                'success' => true,
            ];
        } catch (\Throwable $th) {
            return buildErrorResponse($th);
        }
    }
}
