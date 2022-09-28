<?php

namespace App\Http\Controllers\Api\V1\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBestSellerRequest;
use App\Http\Requests\UpdateBestSellerRequest;
use App\Http\Resources\Admin\BestSellerResource;
use App\Models\BestSeller;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BestSellersApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('best_seller_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BestSellerResource(BestSeller::with(['product'])->get());
    }

    public function show(BestSeller $bestSeller)
    {
        abort_if(Gate::denies('best_seller_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BestSellerResource($bestSeller->load(['product']));
    }

}
