<?php

namespace App\Http\Controllers\Api\V1\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreProductBannerOneRequest;
use App\Http\Requests\UpdateProductBannerOneRequest;
use App\Http\Resources\Admin\ProductBannerOneResource;
use App\Models\ProductBannerOne;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductBannerOneApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        return new ProductBannerOneResource(ProductBannerOne::with(['products'])->get());
    }

    public function show(ProductBannerOne $productBannerOne)
    {

        return new ProductBannerOneResource($productBannerOne->load(['products']));
    }

}
