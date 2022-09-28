<?php

namespace App\Http\Controllers\Api\V1\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFeaturedProductRequest;
use App\Http\Requests\UpdateFeaturedProductRequest;
use App\Http\Resources\Admin\FeaturedProductResource;
use App\Models\FeaturedProduct;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FeaturedProductApiController extends Controller
{
    public function index()
    {

        return new FeaturedProductResource(FeaturedProduct::with(['product'])->get());
    }


    public function show(FeaturedProduct $featuredProduct)
    {
        return new FeaturedProductResource($featuredProduct->load(['product']));
    }

}
