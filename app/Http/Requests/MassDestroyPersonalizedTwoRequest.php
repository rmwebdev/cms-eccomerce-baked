<?php

namespace App\Http\Requests;

use App\Models\PersonalizedTwo;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPersonalizedTwoRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('personalized_two_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:personalized_twos,id',
        ];
    }
}
