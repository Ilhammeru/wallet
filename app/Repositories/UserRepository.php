<?php

namespace App\Repositories;
use App\Models\User;

class UserRepository {
    const PRIMARY_KEY = 'id';

    private $User;

    public function __construct(User $User)
    {
        $this->User = $User;
    }

    /**
    * Function to get all list in the database
    *
    */
    public function list($select = '*', $where = null, $relation = null)
    {
        $query = $this->User->query();
        $query->selectRaw($select);

        if ($relation) {
            $query->with($relation);
        }

        if ($where) {
            $query->whereRaw($where);
        }

        return $query->paginate(10);
    }

    /**
    * Function to store data to database
    * Logic will run in services
    * @param array $data
    *
    */
    public function store(array $data)
    {
        return $this->User->create($data);
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
        return $this->User->where(self::PRIMARY_KEY, $id)->update($data);
    }

    /**
    * Function to get detail data
    * @param string|int $id
    *
    * @return object
    */
    public function detail(string|int $id, $select = '*', $relation = null)
    {
        $query = $this->User->query();
        $query->selectRaw($select);

        if ($relation) {
            $query->with($relation);
        }

        $data = $query->find($id);

        // show wallets
        collect($data->wallets)->map(function ($item) {
            $lang = $item->name;
            $item['name'] = __("{$lang}");

            return $item;
        });

        return $data;
    }

    public function initWallet(array $data)
    {
        // set payload

        $user = $this->User->find(decodeID($data['user_id']));

        $user->createWallet($data);
    }

    /**
    * Function to delete data
    * @param string|int $id
    */
    public function delete(string|int $id)
    {
        return $this->User->where(self::PRIMARY_KEY, $id)->delete();
    }
}
