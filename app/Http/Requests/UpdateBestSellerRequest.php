<?php

namespace App\Http\Requests;

use App\Models\BestSeller;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBestSellerRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('best_seller_edit');
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
