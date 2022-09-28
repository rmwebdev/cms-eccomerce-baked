<?php

namespace App\Http\Controllers\Api\V1\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\Admin\ProductResource;
use App\Models\Product;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {

        return new ProductResource(Product::with(['categories', 'tags', 'user_create', 'user_update'])->get());
    }



    public function show(Product $product)
    {

        return new ProductResource($product->load(['categories', 'tags', 'user_create', 'user_update']));
    }

}
