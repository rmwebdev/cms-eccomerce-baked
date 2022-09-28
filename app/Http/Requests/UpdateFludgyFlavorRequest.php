<?php

namespace App\Http\Requests;

use App\Models\FludgyFlavor;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateFludgyFlavorRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('fludgy_flavor_edit');
    }

    public function rules()
    {
        return [
            'banner_tittle' => [
                'string',
                'min:5',
                'max:100',
                'nullable',
            ],
            'product_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
