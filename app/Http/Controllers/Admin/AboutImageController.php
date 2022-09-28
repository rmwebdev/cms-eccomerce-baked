<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAboutImageRequest;
use App\Http\Requests\StoreAboutImageRequest;
use App\Http\Requests\UpdateAboutImageRequest;
use App\Models\AboutImage;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AboutImageController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('about_image_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = AboutImage::query()->select(sprintf('%s.*', (new AboutImage())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'about_image_show';
                $editGate = 'about_image_edit';
                $deleteGate = 'about_image_delete';
                $crudRoutePart = 'about-images';

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
            $table->editColumn('sub_tittle', function ($row) {
                return $row->sub_tittle ? $row->sub_tittle : '';
            });
            $table->editColumn('img_one', function ($row) {
                if ($photo = $row->img_one) {
                    return sprintf(
        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
        $photo->url,
        $photo->thumbnail
    );
                }

                return '';
            });
            $table->editColumn('img_two', function ($row) {
                if ($photo = $row->img_two) {
                    return sprintf(
        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
        $photo->url,
        $photo->thumbnail
    );
                }

                return '';
            });
            $table->editColumn('img_tree', function ($row) {
                if ($photo = $row->img_tree) {
                    return sprintf(
        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
        $photo->url,
        $photo->thumbnail
    );
                }

                return '';
            });
            $table->editColumn('img_four', function ($row) {
                if ($photo = $row->img_four) {
                    return sprintf(
        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
        $photo->url,
        $photo->thumbnail
    );
                }

                return '';
            });

            $table->rawColumns(['actions', 'placeholder', 'img_one', 'img_two', 'img_tree', 'img_four']);

            return $table->make(true);
        }

        return view('admin.aboutImages.index');
    }

    public function create()
    {
        abort_if(Gate::denies('about_image_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.aboutImages.create');
    }

    public function store(StoreAboutImageRequest $request)
    {
        $aboutImage = AboutImage::create($request->all());

        if ($request->input('img_one', false)) {
            $aboutImage->addMedia(storage_path('tmp/uploads/' . basename($request->input('img_one'))))->toMediaCollection('img_one');
        }

        if ($request->input('img_two', false)) {
            $aboutImage->addMedia(storage_path('tmp/uploads/' . basename($request->input('img_two'))))->toMediaCollection('img_two');
        }

        if ($request->input('img_tree', false)) {
            $aboutImage->addMedia(storage_path('tmp/uploads/' . basename($request->input('img_tree'))))->toMediaCollection('img_tree');
        }

        if ($request->input('img_four', false)) {
            $aboutImage->addMedia(storage_path('tmp/uploads/' . basename($request->input('img_four'))))->toMediaCollection('img_four');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $aboutImage->id]);
        }

        return redirect()->route('admin.about-images.index');
    }

    public function edit(AboutImage $aboutImage)
    {
        abort_if(Gate::denies('about_image_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.aboutImages.edit', compact('aboutImage'));
    }

    public function update(UpdateAboutImageRequest $request, AboutImage $aboutImage)
    {
        $aboutImage->update($request->all());

        if ($request->input('img_one', false)) {
            if (!$aboutImage->img_one || $request->input('img_one') !== $aboutImage->img_one->file_name) {
                if ($aboutImage->img_one) {
                    $aboutImage->img_one->delete();
                }
                $aboutImage->addMedia(storage_path('tmp/uploads/' . basename($request->input('img_one'))))->toMediaCollection('img_one');
            }
        } elseif ($aboutImage->img_one) {
            $aboutImage->img_one->delete();
        }

        if ($request->input('img_two', false)) {
            if (!$aboutImage->img_two || $request->input('img_two') !== $aboutImage->img_two->file_name) {
                if ($aboutImage->img_two) {
                    $aboutImage->img_two->delete();
                }
                $aboutImage->addMedia(storage_path('tmp/uploads/' . basename($request->input('img_two'))))->toMediaCollection('img_two');
            }
        } elseif ($aboutImage->img_two) {
            $aboutImage->img_two->delete();
        }

        if ($request->input('img_tree', false)) {
            if (!$aboutImage->img_tree || $request->input('img_tree') !== $aboutImage->img_tree->file_name) {
                if ($aboutImage->img_tree) {
                    $aboutImage->img_tree->delete();
                }
                $aboutImage->addMedia(storage_path('tmp/uploads/' . basename($request->input('img_tree'))))->toMediaCollection('img_tree');
            }
        } elseif ($aboutImage->img_tree) {
            $aboutImage->img_tree->delete();
        }

        if ($request->input('img_four', false)) {
            if (!$aboutImage->img_four || $request->input('img_four') !== $aboutImage->img_four->file_name) {
                if ($aboutImage->img_four) {
                    $aboutImage->img_four->delete();
                }
                $aboutImage->addMedia(storage_path('tmp/uploads/' . basename($request->input('img_four'))))->toMediaCollection('img_four');
            }
        } elseif ($aboutImage->img_four) {
            $aboutImage->img_four->delete();
        }

        return redirect()->route('admin.about-images.index');
    }

    public function show(AboutImage $aboutImage)
    {
        abort_if(Gate::denies('about_image_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.aboutImages.show', compact('aboutImage'));
    }

    public function destroy(AboutImage $aboutImage)
    {
        abort_if(Gate::denies('about_image_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $aboutImage->delete();

        return back();
    }

    public function massDestroy(MassDestroyAboutImageRequest $request)
    {
        AboutImage::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('about_image_create') && Gate::denies('about_image_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new AboutImage();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
