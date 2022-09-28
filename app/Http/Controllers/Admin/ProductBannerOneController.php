<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyProductBannerOneRequest;
use App\Http\Requests\StoreProductBannerOneRequest;
use App\Http\Requests\UpdateProductBannerOneRequest;
use App\Models\Product;
use App\Models\ProductBannerOne;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ProductBannerOneController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('product_banner_one_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ProductBannerOne::with(['products'])->select(sprintf('%s.*', (new ProductBannerOne())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'product_banner_one_show';
                $editGate = 'product_banner_one_edit';
                $deleteGate = 'product_banner_one_delete';
                $crudRoutePart = 'product-banner-ones';

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

        return view('admin.productBannerOnes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('product_banner_one_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.productBannerOnes.create', compact('products'));
    }

    public function store(StoreProductBannerOneRequest $request)
    {
        $productBannerOne = ProductBannerOne::create($request->all());

        if ($request->input('image', false)) {
            $productBannerOne->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $productBannerOne->id]);
        }

        return redirect()->route('admin.product-banner-ones.index');
    }

    public function edit(ProductBannerOne $productBannerOne)
    {
        abort_if(Gate::denies('product_banner_one_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $productBannerOne->load('products');

        return view('admin.productBannerOnes.edit', compact('productBannerOne', 'products'));
    }

    public function update(UpdateProductBannerOneRequest $request, ProductBannerOne $productBannerOne)
    {
        $productBannerOne->update($request->all());

        if ($request->input('image', false)) {
            if (!$productBannerOne->image || $request->input('image') !== $productBannerOne->image->file_name) {
                if ($productBannerOne->image) {
                    $productBannerOne->image->delete();
                }
                $productBannerOne->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($productBannerOne->image) {
            $productBannerOne->image->delete();
        }

        return redirect()->route('admin.product-banner-ones.index');
    }

    public function show(ProductBannerOne $productBannerOne)
    {
        abort_if(Gate::denies('product_banner_one_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productBannerOne->load('products');

        return view('admin.productBannerOnes.show', compact('productBannerOne'));
    }

    public function destroy(ProductBannerOne $productBannerOne)
    {
        abort_if(Gate::denies('product_banner_one_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productBannerOne->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductBannerOneRequest $request)
    {
        ProductBannerOne::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('product_banner_one_create') && Gate::denies('product_banner_one_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ProductBannerOne();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
