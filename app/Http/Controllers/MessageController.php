<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        return Message::with(['writer', 'reader', 'spot'])->get();
    }

    public function show(Message $message)
    {
        return $message->load(['writer', 'reader', 'spot']);
    }

    public function store(MessageRequest $request)
    {
        $message = Message::create($request->validated());
        return response()->json($message, 201);
    }

    public function update(MessageRequest $request, Message $message)
    {
        $message->update($request->validated());
        return response()->json($message, 200);
    }

    public function destroy(Message $message)
    {
        $message->delete();

        return response()->json(null, 204);
    }

    public function getOneByData($dataName, $uniqueData)
    {
        $result = Message::where($dataName, $uniqueData)->latest('updated_at')->first();
        return $result ? $result : null; // Return null if no result is found
    }

    public function getMultiByData($dataName, $Data)
    {
        $results = Message::where($dataName, $Data)->get();
        return $results->isEmpty() ? null : $results; // Return null if no results are found
    }

}
