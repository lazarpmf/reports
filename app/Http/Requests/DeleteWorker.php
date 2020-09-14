<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeleteWorker extends FormRequest
{

    public function authorize()
    {
        return auth()->user()->role === 1;
    }

    public function rules()
    {
        return [
            //
        ];
    }
}
