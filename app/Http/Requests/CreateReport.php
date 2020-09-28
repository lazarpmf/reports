<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateReport extends FormRequest
{

    public function authorize()
    {
        return true;
        // treba da napravim da samo moze da kreira onaj ko je u timu, kasnije kad to napravim.
    }

    public function rules()
    {
        return [
            'project' => 'required|string',
            'description' => 'required|string|max:4999',
        ];
    }
}
