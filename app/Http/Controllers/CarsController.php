<?php

namespace App\Http\Controllers;

use App\Models\Cars;
use App\Http\Requests\CarRequest;
use phpDocumentor\Reflection\Types\Integer;

class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Cars::paginate();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function store(CarRequest $request)
    {
        return Cars::create($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cars  $cars
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        return Cars::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CarRequest  $request
     * @param  \App\Models\Cars  $cars
     * @return \Illuminate\Http\Response
     */
    public function update(CarRequest $request, Cars $cars, int $id)
    {
//        var_dump($id);
        $car = $cars->findOrFail($id);
        $car->fill($request->validated());
        return $car->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cars  $cars
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        if (!Cars::destroy($id)) {
            return response('not found', 404);
        }
        return response('delete was successed', 201);;
    }
}
