<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBestSellerRequest;
use App\Http\Requests\StoreBestSellerRequest;
use App\Http\Requests\UpdateBestSellerRequest;
use App\Models\BestSeller;
use App\Models\Product;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BestSellersController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('best_seller_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = BestSeller::with(['product'])->select(sprintf('%s.*', (new BestSeller())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'best_seller_show';
                $editGate = 'best_seller_edit';
                $deleteGate = 'best_seller_delete';
                $crudRoutePart = 'best-sellers';

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

        return view('admin.bestSellers.index');
    }

    public function create()
    {
        abort_if(Gate::denies('best_seller_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.bestSellers.create', compact('products'));
    }

    public function store(StoreBestSellerRequest $request)
    {
        $bestSeller = BestSeller::create($request->all());

        return redirect()->route('admin.best-sellers.index');
    }

    public function edit(BestSeller $bestSeller)
    {
        abort_if(Gate::denies('best_seller_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bestSeller->load('product');

        return view('admin.bestSellers.edit', compact('bestSeller', 'products'));
    }

    public function update(UpdateBestSellerRequest $request, BestSeller $bestSeller)
    {
        $bestSeller->update($request->all());

        return redirect()->route('admin.best-sellers.index');
    }

    public function show(BestSeller $bestSeller)
    {
        abort_if(Gate::denies('best_seller_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bestSeller->load('product');

        return view('admin.bestSellers.show', compact('bestSeller'));
    }

    public function destroy(BestSeller $bestSeller)
    {
        abort_if(Gate::denies('best_seller_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bestSeller->delete();

        return back();
    }

    public function massDestroy(MassDestroyBestSellerRequest $request)
    {
        BestSeller::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
