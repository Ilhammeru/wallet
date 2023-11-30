<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Package\Create;
use App\Http\Requests\Package\Update;
use App\Services\PackageService;

class PackageController extends Controller
{
    private $service;

    public function __construct(PackageService $service)
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
        $filter = [
            'name' => request()->name,
            'perPage' => request()->perPage,
        ];
        return $this->response($this->service->list($filter));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \{{storeRequestNamespaced}} $request
     * @return \Illuminate\Http\Response
     */
    public function store(Create $request)
    {
        return $this->response($this->service->store($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int|string $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->response($this->service->show($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \{{updateRequestNamespaced}}  $request
     * @param int|string $id
     * @return \Illuminate\Http\Response
     */
    public function update(Update $request, $id)
    {
        return $this->response($this->service->update($request->validated(), $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int|string $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->response($this->service->delete($id));
    }
}
