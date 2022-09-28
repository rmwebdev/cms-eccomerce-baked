<?php

namespace App\Http\Controllers\Api\V1\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreProductCategoryRequest;
use App\Http\Requests\UpdateProductCategoryRequest;
use App\Http\Resources\Admin\ProductCategoryResource;
use App\Models\ProductCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductCategoryApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {

        return new ProductCategoryResource(ProductCategory::with(['user_create', 'user_update'])->get());
    }


    public function show(ProductCategory $productCategory)
    {
        return new ProductCategoryResource($productCategory->load(['user_create', 'user_update']));
    }

}
