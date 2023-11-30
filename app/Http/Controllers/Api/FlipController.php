<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Flip\Create;
use App\Http\Requests\Flip\Update;
use App\Services\FlipService;
use Illuminate\Http\Request;

class FlipController extends Controller
{
    private $service;

    public function __construct(FlipService $service)
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

    public function acceptPayment(Request $request)
    {
        $data = json_decode($request);

        if (strtolower($data->status) == "failed") {

        } else if (strtolower($data->status) == "successful") {

        }
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
