<?php

namespace App\Repositories;
use App\Models\Wallet;

class WalletRepository {
    const PRIMARY_KEY = 'id';

    private $Wallet;

    public function __construct(Wallet $Wallet)
    {
        $this->Wallet = $Wallet;
    }

    /**
    * Function to get all list in the database
    *
    */
    public function list($select = '*', $where = null, $relation = null)
    {
        $query = $this->Wallet->query();
        $query->selectRaw($select);

        if ($relation) {
            $query->with($relation);
        }

        if ($where) {
            $query->whereRaw($where);
        }

        return $query->get();
    }

    /**
    * Function to store data to database
    * Logic will run in services
    * @param array $data
    *
    */
    public function store(array $data)
    {
        return $this->Wallet->create($data);
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
        return $this->Wallet->where(self::PRIMARY_KEY, $id)->update($data);
    }

    /**
    * Function to get detail data
    * @param string|int $id
    *
    * @return object
    */
    public function detail(string|int $id, $select = '*')
    {
        return $this->Wallet->selectRaw($select)->find($id);
    }

    /**
    * Function to delete data
    * @param string|int $id
    */
    public function delete(string|int $id)
    {
        return $this->Wallet->where(self::PRIMARY_KEY, $id)->delete();
    }
}
