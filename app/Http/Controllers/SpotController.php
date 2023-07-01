<?php

namespace App\Http\Controllers;

use App\Http\Requests\SpotRequest;
use App\Models\Spot;
use Illuminate\Http\Request;

class SpotController extends Controller
{
    public function index()
    {
        return Spot::all();
    }

    public function show(Spot $spot)
    {
        return $spot;
    }

    public function store(SpotRequest $request)
    {
        $spot = Spot::create($request->validated());
        return response()->json($spot, 201);
    }

    public function update(SpotRequest $request, Spot $spot)
    {
        $spot->update($request->validated());
        return response()->json($spot, 200);
    }

    public function destroy(Spot $spot)
    {
        $spot->delete();

        return response()->json(null, 204);
    }

    public function getOneByData($dataName, $uniqueData)
    {
        return Spot::where($dataName, $uniqueData)->first();
    }

    public function getMultiByData($dataName, $Data)
    {
        return Spot::where($dataName, $Data)->get();
    }
}
