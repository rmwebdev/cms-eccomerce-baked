<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyWhatWeHaveRequest;
use App\Http\Requests\StoreWhatWeHaveRequest;
use App\Http\Requests\UpdateWhatWeHaveRequest;
use App\Models\WhatWeHave;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class WhatWeHaveController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('what_we_have_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = WhatWeHave::query()->select(sprintf('%s.*', (new WhatWeHave())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'what_we_have_show';
                $editGate = 'what_we_have_edit';
                $deleteGate = 'what_we_have_delete';
                $crudRoutePart = 'what-we-haves';

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
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.whatWeHaves.index');
    }

    public function create()
    {
        abort_if(Gate::denies('what_we_have_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.whatWeHaves.create');
    }

    public function store(StoreWhatWeHaveRequest $request)
    {
        $whatWeHave = WhatWeHave::create($request->all());

        return redirect()->route('admin.what-we-haves.index');
    }

    public function edit(WhatWeHave $whatWeHave)
    {
        abort_if(Gate::denies('what_we_have_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.whatWeHaves.edit', compact('whatWeHave'));
    }

    public function update(UpdateWhatWeHaveRequest $request, WhatWeHave $whatWeHave)
    {
        $whatWeHave->update($request->all());

        return redirect()->route('admin.what-we-haves.index');
    }

    public function show(WhatWeHave $whatWeHave)
    {
        abort_if(Gate::denies('what_we_have_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.whatWeHaves.show', compact('whatWeHave'));
    }

    public function destroy(WhatWeHave $whatWeHave)
    {
        abort_if(Gate::denies('what_we_have_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $whatWeHave->delete();

        return back();
    }

    public function massDestroy(MassDestroyWhatWeHaveRequest $request)
    {
        WhatWeHave::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
