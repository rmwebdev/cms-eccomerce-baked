<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPersonalizedTwoRequest;
use App\Http\Requests\StorePersonalizedTwoRequest;
use App\Http\Requests\UpdatePersonalizedTwoRequest;
use App\Models\PersonalizedTwo;
use App\Models\Product;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PersonalizedTwoController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('personalized_two_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PersonalizedTwo::with(['products'])->select(sprintf('%s.*', (new PersonalizedTwo())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'personalized_two_show';
                $editGate = 'personalized_two_edit';
                $deleteGate = 'personalized_two_delete';
                $crudRoutePart = 'personalized-twos';

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

        return view('admin.personalizedTwos.index');
    }

    public function create()
    {
        abort_if(Gate::denies('personalized_two_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.personalizedTwos.create', compact('products'));
    }

    public function store(StorePersonalizedTwoRequest $request)
    {
        $personalizedTwo = PersonalizedTwo::create($request->all());

        if ($request->input('image', false)) {
            $personalizedTwo->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $personalizedTwo->id]);
        }

        return redirect()->route('admin.personalized-twos.index');
    }

    public function edit(PersonalizedTwo $personalizedTwo)
    {
        abort_if(Gate::denies('personalized_two_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $personalizedTwo->load('products');

        return view('admin.personalizedTwos.edit', compact('personalizedTwo', 'products'));
    }

    public function update(UpdatePersonalizedTwoRequest $request, PersonalizedTwo $personalizedTwo)
    {
        $personalizedTwo->update($request->all());

        if ($request->input('image', false)) {
            if (!$personalizedTwo->image || $request->input('image') !== $personalizedTwo->image->file_name) {
                if ($personalizedTwo->image) {
                    $personalizedTwo->image->delete();
                }
                $personalizedTwo->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($personalizedTwo->image) {
            $personalizedTwo->image->delete();
        }

        return redirect()->route('admin.personalized-twos.index');
    }

    public function show(PersonalizedTwo $personalizedTwo)
    {
        abort_if(Gate::denies('personalized_two_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $personalizedTwo->load('products');

        return view('admin.personalizedTwos.show', compact('personalizedTwo'));
    }

    public function destroy(PersonalizedTwo $personalizedTwo)
    {
        abort_if(Gate::denies('personalized_two_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $personalizedTwo->delete();

        return back();
    }

    public function massDestroy(MassDestroyPersonalizedTwoRequest $request)
    {
        PersonalizedTwo::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('personalized_two_create') && Gate::denies('personalized_two_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new PersonalizedTwo();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
