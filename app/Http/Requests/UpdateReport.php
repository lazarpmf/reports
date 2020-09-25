<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReport extends FormRequest
{

    public function authorize()
    {
        // return auth()->user()->id === $this->report->user_id;
        return true;
    }

    public function rules()
    {
        return [
            'project' => 'required|string',
            'description' => 'required|string|max:999',
        ];
    }
}
