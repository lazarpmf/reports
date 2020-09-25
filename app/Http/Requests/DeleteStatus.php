<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeleteStatus extends FormRequest
{

    public function authorize()
    {
        return auth()->user()->id === $this->status->user_id;
    }

    public function rules()
    {
        return [
            //
        ];
    }
}
