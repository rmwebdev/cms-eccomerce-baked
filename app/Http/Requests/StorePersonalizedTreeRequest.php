<?php

namespace App\Http\Requests;

use App\Models\PersonalizedTree;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePersonalizedTreeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('personalized_tree_create');
    }

    public function rules()
    {
        return [
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
