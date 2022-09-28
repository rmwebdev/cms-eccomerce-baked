<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySpesialOfferRequest;
use App\Http\Requests\StoreSpesialOfferRequest;
use App\Http\Requests\UpdateSpesialOfferRequest;
use App\Models\Product;
use App\Models\SpesialOffer;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SpesialOffersController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('spesial_offer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = SpesialOffer::with(['product'])->select(sprintf('%s.*', (new SpesialOffer())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'spesial_offer_show';
                $editGate = 'spesial_offer_edit';
                $deleteGate = 'spesial_offer_delete';
                $crudRoutePart = 'spesial-offers';

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
            $table->editColumn('discount', function ($row) {
                return $row->discount ? $row->discount : '';
            });
            $table->addColumn('product_name', function ($row) {
                return $row->product ? $row->product->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'product']);

            return $table->make(true);
        }

        return view('admin.spesialOffers.index');
    }

    public function create()
    {
        abort_if(Gate::denies('spesial_offer_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.spesialOffers.create', compact('products'));
    }

    public function store(StoreSpesialOfferRequest $request)
    {
        $spesialOffer = SpesialOffer::create($request->all());

        return redirect()->route('admin.spesial-offers.index');
    }

    public function edit(SpesialOffer $spesialOffer)
    {
        abort_if(Gate::denies('spesial_offer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $spesialOffer->load('product');

        return view('admin.spesialOffers.edit', compact('products', 'spesialOffer'));
    }

    public function update(UpdateSpesialOfferRequest $request, SpesialOffer $spesialOffer)
    {
        $spesialOffer->update($request->all());

        return redirect()->route('admin.spesial-offers.index');
    }

    public function show(SpesialOffer $spesialOffer)
    {
        abort_if(Gate::denies('spesial_offer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $spesialOffer->load('product');

        return view('admin.spesialOffers.show', compact('spesialOffer'));
    }

    public function destroy(SpesialOffer $spesialOffer)
    {
        abort_if(Gate::denies('spesial_offer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $spesialOffer->delete();

        return back();
    }

    public function massDestroy(MassDestroySpesialOfferRequest $request)
    {
        SpesialOffer::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
