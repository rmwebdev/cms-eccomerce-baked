<?php

namespace App\Http\Controllers\Api\V1\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSpesialOfferRequest;
use App\Http\Requests\UpdateSpesialOfferRequest;
use App\Http\Resources\Admin\SpesialOfferResource;
use App\Models\SpesialOffer;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SpesialOffersApiController extends Controller
{
    public function index()
    {

        return new SpesialOfferResource(SpesialOffer::with(['product'])->get());
    }

    public function show(SpesialOffer $spesialOffer)
    {
        return new SpesialOfferResource($spesialOffer->load(['product']));
    }
}
