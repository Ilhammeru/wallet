<?php

namespace App\Repositories;
use App\Models\Feature;

class FeatureRepository {
    const PRIMARY_KEY = 'id';

    private $Feature;
    private $perPage;

    public function __construct(Feature $Feature)
    {
        $this->Feature = $Feature;
        $this->perPage = 10;
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
