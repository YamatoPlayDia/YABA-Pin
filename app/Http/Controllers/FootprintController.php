<?php

namespace App\Http\Controllers;

use App\Http\Requests\FootprintRequest;
use App\Models\Footprint;
use Illuminate\Http\Request;

class FootprintController extends Controller
{
    public function index()
    {
        return Footprint::all();
    }

    public function show(Footprint $footprint)
    {
        return $footprint;
    }

    public function store(FootprintRequest $request)
    {
        $footprint = Footprint::create($request->validated());
        return response()->json($footprint, 201);
    }

    public function update(FootprintRequest $request, Footprint $footprint)
    {
        $footprint->update($request->validated());
        return response()->json($footprint, 200);
    }

    public function destroy(Footprint $footprint)
    {
        $footprint->delete();

        return response()->json(null, 204);
    }

    public function getOneByData($dataName, $uniqueData)
    {
        return Footprint::where($dataName, $uniqueData)->first();
    }

    public function getMultiByData($dataName, $Data)
    {
        return Footprint::where($dataName, $Data)->get();
    }
}
