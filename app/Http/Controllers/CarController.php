<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;

class CarController extends Controller
{

    public function __construct() {
        // $car = new Car();
        // $car->model='Toyota';
        // $car->color='Red';
        // $car->year=2023;
        // $car->price=50000.0;
        // $car->save();
    }

    public function index()
    {
        $cars = Car::all();
        if ($cars->isEmpty()) {
            return ($cars->toJson());
        }
        return response()->json(["message"=>"Cars not found"],404);

    }

    public function create()
    {
        //
    }


    public function store(StoreCarRequest $request)
    {
        // $car = Car::create($request->only(['model','type','year','price','color']));
        $validated = $request->validated();
        $car = Car::create($validated);
        return response()->json($validated,201);
    }


    public function show(string $id)
    {
        // $car = Car::where('id',$id)->first();
        $car = Car::findOrFail($id);
        $car = Car::find($id);
        if ($car) {
            return response()->json($car);
        }
        return response()->json(["message"=>"Car not found"],404);
        
    }


    public function edit(Car $car)
    {
        //
    }

    public function update(UpdateCarRequest $request, string $id)
    {
        $validated = $request->validated();
        $car = Car::find($id);
        if ($car) {
            $car->update($validated);
            return response()->json($car,200);
        }
        return response()->json(["message"=>"Car not found"],404);

    }


    public function destroy(string $id)
    {
        // $destroyed = Car::destroy($id);
        // if ($destroyed>=1) {
        //     return response()->json(["message"=>"Car deleted successfully"],200);
        // }
        // return response()->json(["message"=>"Car not found"],404);


        $car = Car::find($id);
        if ($car) {
            $car->delete();
            return response()->json(["message"=>"Car deleted successfully"],204);
        }
        return response()->json(["message"=>"Car not found"],404);

    }
}
