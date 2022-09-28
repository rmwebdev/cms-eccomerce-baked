<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyFludgyFlavorRequest;
use App\Http\Requests\StoreFludgyFlavorRequest;
use App\Http\Requests\UpdateFludgyFlavorRequest;
use App\Models\FludgyFlavor;
use App\Models\Product;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class FludgyFlavorsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('fludgy_flavor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = FludgyFlavor::with(['product'])->select(sprintf('%s.*', (new FludgyFlavor())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'fludgy_flavor_show';
                $editGate = 'fludgy_flavor_edit';
                $deleteGate = 'fludgy_flavor_delete';
                $crudRoutePart = 'fludgy-flavors';

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
            $table->editColumn('banner_tittle', function ($row) {
                return $row->banner_tittle ? $row->banner_tittle : '';
            });
            $table->addColumn('product_name', function ($row) {
                return $row->product ? $row->product->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'product']);

            return $table->make(true);
        }

        return view('admin.fludgyFlavors.index');
    }

    public function create()
    {
        abort_if(Gate::denies('fludgy_flavor_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.fludgyFlavors.create', compact('products'));
    }

    public function store(StoreFludgyFlavorRequest $request)
    {
        $fludgyFlavor = FludgyFlavor::create($request->all());

        return redirect()->route('admin.fludgy-flavors.index');
    }

    public function edit(FludgyFlavor $fludgyFlavor)
    {
        abort_if(Gate::denies('fludgy_flavor_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $fludgyFlavor->load('product');

        return view('admin.fludgyFlavors.edit', compact('fludgyFlavor', 'products'));
    }

    public function update(UpdateFludgyFlavorRequest $request, FludgyFlavor $fludgyFlavor)
    {
        $fludgyFlavor->update($request->all());

        return redirect()->route('admin.fludgy-flavors.index');
    }

    public function show(FludgyFlavor $fludgyFlavor)
    {
        abort_if(Gate::denies('fludgy_flavor_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fludgyFlavor->load('product');

        return view('admin.fludgyFlavors.show', compact('fludgyFlavor'));
    }

    public function destroy(FludgyFlavor $fludgyFlavor)
    {
        abort_if(Gate::denies('fludgy_flavor_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fludgyFlavor->delete();

        return back();
    }

    public function massDestroy(MassDestroyFludgyFlavorRequest $request)
    {
        FludgyFlavor::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
