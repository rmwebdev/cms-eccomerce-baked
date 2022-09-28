<?php

namespace App\Http\Requests;

use App\Models\WhatWeHave;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateWhatWeHaveRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('what_we_have_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'description' => [
                'required',
            ],
        ];
    }
}
