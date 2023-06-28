<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest
{
    public function rules()
    {
        return [
            'writer_id' => 'required|integer|exists:users,id',
            'reader_id' => 'required|integer|exists:users,id',
            'himitsu' => 'required|string',
            'spot_id' => 'required|integer|exists:spots,id',
            'status' => 'required|string',
        ];
    }
}
