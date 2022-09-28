<?php

namespace App\Http\Requests;

use App\Models\ProductBannerTwo;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreProductBannerTwoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product_banner_two_create');
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
