<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyProductBannerTwoRequest;
use App\Http\Requests\StoreProductBannerTwoRequest;
use App\Http\Requests\UpdateProductBannerTwoRequest;
use App\Models\Product;
use App\Models\ProductBannerTwo;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ProductBannerTwoController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('product_banner_two_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ProductBannerTwo::with(['products'])->select(sprintf('%s.*', (new ProductBannerTwo())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'product_banner_two_show';
                $editGate = 'product_banner_two_edit';
                $deleteGate = 'product_banner_two_delete';
                $crudRoutePart = 'product-banner-twos';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('tittle_banner', function ($row) {
                return $row->tittle_banner ? $row->tittle_banner : '';
            });
            $table->addColumn('products_name', function ($row) {
                return $row->products ? $row->products->name : '';
            });

            $table->editColumn('discount', function ($row) {
                return $row->discount ? $row->discount : '';
            });
            $table->editColumn('image', function ($row) {
                if ($photo = $row->image) {
                    return sprintf(
        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
        $photo->url,
        $photo->thumbnail
    );
                }

                return '';
            });

            $table->rawColumns(['actions', 'placeholder', 'products', 'image']);

            return $table->make(true);
        }

        return view('admin.productBannerTwos.index');
    }

    public function create()
    {
        abort_if(Gate::denies('product_banner_two_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.productBannerTwos.create', compact('products'));
    }

    public function store(StoreProductBannerTwoRequest $request)
    {
        $productBannerTwo = ProductBannerTwo::create($request->all());

        if ($request->input('image', false)) {
            $productBannerTwo->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $productBannerTwo->id]);
        }

        return redirect()->route('admin.product-banner-twos.index');
    }

    public function edit(ProductBannerTwo $productBannerTwo)
    {
        abort_if(Gate::denies('product_banner_two_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $productBannerTwo->load('products');

        return view('admin.productBannerTwos.edit', compact('productBannerTwo', 'products'));
    }

    public function update(UpdateProductBannerTwoRequest $request, ProductBannerTwo $productBannerTwo)
    {
        $productBannerTwo->update($request->all());

        if ($request->input('image', false)) {
            if (!$productBannerTwo->image || $request->input('image') !== $productBannerTwo->image->file_name) {
                if ($productBannerTwo->image) {
                    $productBannerTwo->image->delete();
                }
                $productBannerTwo->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($productBannerTwo->image) {
            $productBannerTwo->image->delete();
        }

        return redirect()->route('admin.product-banner-twos.index');
    }

    public function show(ProductBannerTwo $productBannerTwo)
    {
        abort_if(Gate::denies('product_banner_two_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productBannerTwo->load('products');

        return view('admin.productBannerTwos.show', compact('productBannerTwo'));
    }

    public function destroy(ProductBannerTwo $productBannerTwo)
    {
        abort_if(Gate::denies('product_banner_two_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productBannerTwo->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductBannerTwoRequest $request)
    {
        ProductBannerTwo::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('product_banner_two_create') && Gate::denies('product_banner_two_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ProductBannerTwo();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
