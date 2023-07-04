<?php

namespace App\Http\Controllers;

use App\Http\Requests\FootprintRequest;
use App\Models\Footprint;
use Illuminate\Http\Request;
use League\CommonMark\Extension\Footnote\Node\Footnote;

class FootprintController extends Controller
{
    public function index()
    {
        return Footprint::all();
    }

    public function show(Footprint $footprint)
    {
        return $footprint ? $footprint : null;;
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
        $result = Footprint::where($dataName, $uniqueData)->first();
        return $result ? $result : null; // Return null if no result is found
    }

    public function getMultiByData($dataName, $Data)
    {
        $results = Footprint::where($dataName, $Data)->get();
        return $results->isEmpty() ? null : $results; // Return null if no results are found
    }
}
