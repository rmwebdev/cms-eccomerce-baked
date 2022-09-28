<?php

namespace App\Http\Requests;

use App\Models\AboutImage;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAboutImageRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('about_image_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'min:3',
                'max:50',
                'required',
            ],
            'sub_tittle' => [
                'string',
                'min:10',
                'max:100',
                'required',
            ],
        ];
    }
}
