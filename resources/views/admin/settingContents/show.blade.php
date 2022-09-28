@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.settingContent.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.setting-contents.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.settingContent.fields.id') }}
                        </th>
                        <td>
                            {{ $settingContent->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.settingContent.fields.tag_line_product') }}
                        </th>
                        <td>
                            {{ $settingContent->tag_line_product }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.settingContent.fields.product_image') }}
                        </th>
                        <td>
                            @if($settingContent->product_image)
                                <a href="{{ $settingContent->product_image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $settingContent->product_image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.settingContent.fields.thumbnail_video') }}
                        </th>
                        <td>
                            @if($settingContent->thumbnail_video)
                                <a href="{{ $settingContent->thumbnail_video->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $settingContent->thumbnail_video->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.settingContent.fields.url_video') }}
                        </th>
                        <td>
                            {{ $settingContent->url_video }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.settingContent.fields.video') }}
                        </th>
                        <td>
                            @if($settingContent->video)
                                <a href="{{ $settingContent->video->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.setting-contents.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection