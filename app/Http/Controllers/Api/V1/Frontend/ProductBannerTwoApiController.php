<?php

namespace App\Http\Controllers\Api\V1\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreProductBannerTwoRequest;
use App\Http\Requests\UpdateProductBannerTwoRequest;
use App\Http\Resources\Admin\ProductBannerTwoResource;
use App\Models\ProductBannerTwo;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductBannerTwoApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {

        return new ProductBannerTwoResource(ProductBannerTwo::with(['products'])->get());
    }

    public function show(ProductBannerTwo $productBannerTwo)
    {

        return new ProductBannerTwoResource($productBannerTwo->load(['products']));
    }

}
