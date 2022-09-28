<?php

namespace App\Http\Requests;

use App\Models\SpesialOffer;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySpesialOfferRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('spesial_offer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:spesial_offers,id',
        ];
    }
}
