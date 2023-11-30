<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateWallet;
use App\Services\UserService;

class UserController extends Controller
{
    private $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->response($this->service->list());
    }

    public function show(string|int $id)
    {
        return $this->response($this->service->show(decodeID($id)));
    }

    public function createWallet(CreateWallet $request)
    {
        return $this->response($this->service->initWallet($request->validated()));
    }
}
