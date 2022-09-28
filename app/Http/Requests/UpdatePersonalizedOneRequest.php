<?php

namespace App\Http\Requests;

use App\Models\PersonalizedOne;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePersonalizedOneRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('personalized_one_edit');
    }

    public function rules()
    {
        return [
            'tittle_banner' => [
                'string',
                'min:5',
                'max:100',
                'nullable',
            ],
            'products_id' => [
                'required',
                'integer',
            ],
            'discount' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'image' => [
                'required',
            ],
        ];
    }
}
