<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeleteReport extends FormRequest
{

    public function authorize()
    {
        // moze da izbrise samo onaj ko je kreirao report
        // return auth()->user()->id === $this->report->user_id;
        return auth()->user()->id === $this->report->user_id;
    }

    public function rules()
    {
        return [
            //
        ];
    }
}
