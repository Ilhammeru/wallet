<?php

namespace App\Repositories;
use App\Models\Package;
use App\Models\PackageFeature;

class PackageRepository {
    const PRIMARY_KEY = 'id';

    private $Package;
    private $perPage;
    private $PackageFeature;

    public function __construct(Package $Package, PackageFeature $packageFeature)
    {
        $this->Package = $Package;
        $this->PackageFeature = $packageFeature;
        $this->perPage = 10;
    }

    /**
    * Function to get all list in the database
    *
    */
    public function list($select = '*', $where = null, $relation = null)
    {
        $query = $this->Package->query();
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
    * Function to store data to database
    * Logic will run in services
    * @param array $data
    *
    */
    public function store(array $data)
    {
        $package = $this->Package->create($data);

        for ($a = 0; $a < count($data['feature_id']); $a++) {
            $this->PackageFeature->create([
                'feature_id' => $data['feature_id'][$a],
                'package_id' => $package->id,
            ]);
        }

        return $package;
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
        $this->PackageFeature::where('package_id', $id)->delete();

        for ($a = 0; $a < count($data['feature_id']); $a++) {
            $this->PackageFeature::create([
                'package_id' => $id,
                'feature_id' => $data['feature_id'][$a]
            ]);
        }

        unset($data['feature_id']);

        $update = $this->Package->where(self::PRIMARY_KEY, $id)->update($data);

        return $update;
    }

    /**
    * Function to get detail data
    * @param string|int $id
    *
    * @return object
    */
    public function detail(string|int $id, $select = '*')
    {
        return $this->Package->selectRaw($select)->find($id);
    }

    /**
    * Function to delete data
    * @param string|int $id
    */
    public function delete(string|int $id)
    {
        $this->PackageFeature->where('package_id', $id)->delete();
        return $this->Package->where(self::PRIMARY_KEY, $id)->delete();
    }
}
