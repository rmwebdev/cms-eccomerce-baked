<?php

namespace App\Http\Requests;

use App\Models\AboutImage;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAboutImageRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('about_image_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:about_images,id',
        ];
    }
}
