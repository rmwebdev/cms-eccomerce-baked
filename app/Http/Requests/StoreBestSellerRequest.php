<?php

namespace App\Http\Requests;

use App\Models\BestSeller;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBestSellerRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('best_seller_create');
    }

    public function rules()
    {
        return [
            'description' => [
                'string',
                'nullable',
            ],
            'product_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
