<?php

namespace App\Http\Controllers\Api\V1\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreProductTagRequest;
use App\Http\Requests\UpdateProductTagRequest;
use App\Http\Resources\Admin\ProductTagResource;
use App\Models\ProductTag;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductTagApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {

        return new ProductTagResource(ProductTag::with(['user_create', 'user_update'])->get());
    }

 
    public function show(ProductTag $productTag)
    {

        return new ProductTagResource($productTag->load(['user_create', 'user_update']));
    }

}
