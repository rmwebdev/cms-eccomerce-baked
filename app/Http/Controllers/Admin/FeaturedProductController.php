<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyFeaturedProductRequest;
use App\Http\Requests\StoreFeaturedProductRequest;
use App\Http\Requests\UpdateFeaturedProductRequest;
use App\Models\FeaturedProduct;
use App\Models\Product;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class FeaturedProductController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('featured_product_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = FeaturedProduct::with(['product'])->select(sprintf('%s.*', (new FeaturedProduct())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'featured_product_show';
                $editGate = 'featured_product_edit';
                $deleteGate = 'featured_product_delete';
                $crudRoutePart = 'featured-products';

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
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->addColumn('product_name', function ($row) {
                return $row->product ? $row->product->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'product']);

            return $table->make(true);
        }

        return view('admin.featuredProducts.index');
    }

    public function create()
    {
        abort_if(Gate::denies('featured_product_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.featuredProducts.create', compact('products'));
    }

    public function store(StoreFeaturedProductRequest $request)
    {
        $featuredProduct = FeaturedProduct::create($request->all());

        return redirect()->route('admin.featured-products.index');
    }

    public function edit(FeaturedProduct $featuredProduct)
    {
        abort_if(Gate::denies('featured_product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $featuredProduct->load('product');

        return view('admin.featuredProducts.edit', compact('featuredProduct', 'products'));
    }

    public function update(UpdateFeaturedProductRequest $request, FeaturedProduct $featuredProduct)
    {
        $featuredProduct->update($request->all());

        return redirect()->route('admin.featured-products.index');
    }

    public function show(FeaturedProduct $featuredProduct)
    {
        abort_if(Gate::denies('featured_product_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $featuredProduct->load('product');

        return view('admin.featuredProducts.show', compact('featuredProduct'));
    }

    public function destroy(FeaturedProduct $featuredProduct)
    {
        abort_if(Gate::denies('featured_product_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $featuredProduct->delete();

        return back();
    }

    public function massDestroy(MassDestroyFeaturedProductRequest $request)
    {
        FeaturedProduct::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
