@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.aboutImage.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.about-images.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.aboutImage.fields.id') }}
                        </th>
                        <td>
                            {{ $aboutImage->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.aboutImage.fields.title') }}
                        </th>
                        <td>
                            {{ $aboutImage->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.aboutImage.fields.sub_tittle') }}
                        </th>
                        <td>
                            {{ $aboutImage->sub_tittle }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.aboutImage.fields.img_one') }}
                        </th>
                        <td>
                            @if($aboutImage->img_one)
                                <a href="{{ $aboutImage->img_one->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $aboutImage->img_one->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.aboutImage.fields.img_two') }}
                        </th>
                        <td>
                            @if($aboutImage->img_two)
                                <a href="{{ $aboutImage->img_two->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $aboutImage->img_two->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.aboutImage.fields.img_tree') }}
                        </th>
                        <td>
                            @if($aboutImage->img_tree)
                                <a href="{{ $aboutImage->img_tree->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $aboutImage->img_tree->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.aboutImage.fields.img_four') }}
                        </th>
                        <td>
                            @if($aboutImage->img_four)
                                <a href="{{ $aboutImage->img_four->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $aboutImage->img_four->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.about-images.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection