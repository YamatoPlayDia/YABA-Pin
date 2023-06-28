<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FootprintRequest extends FormRequest
{
    public function rules()
    {
        return [
            'id' => 'required|integer|exists:users,id',
            'rights_write' => 'required|integer|min:0',
            'rights_read' => 'required|integer|min:0',
            'lastlogin_latitude' => 'nullable|numeric|between:-90,90',
            'lastlogin_longitude' => 'nullable|numeric|between:-180,180',
            'latest_latitude' => 'nullable|numeric|between:-90,90',
            'latest_longitude' => 'nullable|numeric|between:-180,180',
        ];
    }
}
