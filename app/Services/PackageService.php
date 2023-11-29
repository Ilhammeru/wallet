<?php

/**
* Created 11/17/2023 15:13:46
* Use this service to run all logic, then communicate with database through repository
*/

namespace App\Services;
use App\Repositories\PackageRepository;
use Illuminate\Support\Facades\DB;

class PackageService {
    private $repo;

    public function __construct(PackageRepository $PackageRepository)
    {
        $this->repo = $PackageRepository;
    }

    /**
    * Function to get all list
    * @param array $data
    */
    public function list(array $data = [])
    {
        try {
            // get all list
            $relation = ['features.feature:id,name'];

            $where = null;
            if (!empty($data['name'])) {
                $name = $data['name'];
                $where = "name LIKE '%{$name}%'";
            }

            $data = $this->repo->list('*', $where, $relation);

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
        DB::beginTransaction();
        try {
            // decode features id
            $feature_ids = $this->decodeFeatures($data);
            $data['feature_id'] = $feature_ids;

            $store = $this->repo->store($data);

            DB::commit();

            return [
                'data' => $store,
                'message' => __('packages.success_create_package'),
                'success' => true,
            ];
        } catch (\Throwable $th) {
            DB::rollBack();

            return buildErrorResponse($th);
        }
    }

    private function decodeFeatures($data)
    {
        return collect($data['feature_id'])->map(function ($item) {
            $decode = decodeID($item);

            return $decode;
        });
    }

    /**
    * Function to update data
    * @param array $data
    * @param string|int $id
    *
    */
    public function update(array $data, string|int $id)
    {
        DB::beginTransaction();
        try {
            $feature_ids = $this->decodeFeatures($data);
            $data['feature_id'] = $feature_ids;

            $update = $this->repo->update($data, decodeID($id));

            DB::commit();
            return [
                'success' => true,
                'data' => $update,
                'message' => __('packages.success_update_package')
            ];
        } catch (\Throwable $th) {
            DB::rollBack();

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
                'message' => __('packages.success_delete_package'),
                'success' => true,
            ];
        } catch (\Throwable $th) {
            return buildErrorResponse($th);
        }
    }
}
