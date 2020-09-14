<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProject extends FormRequest
{

    public function authorize()
    {
        return auth()->user()->role === 1;
    }

    public function rules()
    {
        return [
            'project' => 'required|string|max:255|unique:projects',
        ];
    }
}
