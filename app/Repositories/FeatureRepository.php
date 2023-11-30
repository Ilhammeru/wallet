<?php

namespace App\Repositories;
use App\Models\Feature;
use App\Models\PackageFeature;

class FeatureRepository {
    const PRIMARY_KEY = 'id';

    private $Feature;
    private $perPage;
    private $PackageFeature;

    public function __construct(Feature $Feature, PackageFeature $PackageFeature)
    {
        $this->Feature = $Feature;
        $this->perPage = 10;
        $this->PackageFeature = $PackageFeature;
    }

    /**
    * Function to get all list in the database
    *
    */
    public function list($select = '*', $where = null, $relation = null)
    {
        $query = $this->Feature->query();
        $query->selectRaw($select);

        if ($relation) {
            $query->with($relation);
        }

        if ($where) {
            $query->whereRaw($where);
        }

        return $query->paginate($this->perPage);
    }

    /**
     * Function to check feature relations
     * @param string|int $featureId
     */
    public function checkPackageFeature(string|int $featureId)
    {
        return $this->PackageFeature->where('feature_id', $featureId)
            ->first();
    }

    /**
    * Function to store data to database
    * Logic will run in services
    * @param array $data
    *
    */
    public function store(array $data)
    {
        return $this->Feature->create($data);
    }

    /**
    * Function to update data
    * Any logic will run in services
    *
    * @param array $data
    * @param string|int $id
    *
    */
    public function update(array $data, string|int $id)
    {
        return $this->Feature->where(self::PRIMARY_KEY, $id)->update($data);
    }

    /**
    * Function to get detail data
    * @param string|int $id
    *
    * @return object
    */
    public function detail(string|int $id, $select = '*')
    {
        return $this->Feature->selectRaw($select)->find($id);
    }

    /**
    * Function to delete data
    * @param string|int $id
    */
    public function delete(string|int $id)
    {
        return $this->Feature->where(self::PRIMARY_KEY, $id)->delete();
    }
}
