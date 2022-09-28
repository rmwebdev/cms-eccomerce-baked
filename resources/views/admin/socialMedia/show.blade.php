@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.socialMedium.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.social-media.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.socialMedium.fields.id') }}
                        </th>
                        <td>
                            {{ $socialMedium->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.socialMedium.fields.email') }}
                        </th>
                        <td>
                            {{ $socialMedium->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.socialMedium.fields.phone') }}
                        </th>
                        <td>
                            {{ $socialMedium->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.socialMedium.fields.facebook') }}
                        </th>
                        <td>
                            {{ $socialMedium->facebook }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.socialMedium.fields.instagram') }}
                        </th>
                        <td>
                            {{ $socialMedium->instagram }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.socialMedium.fields.twitter') }}
                        </th>
                        <td>
                            {{ $socialMedium->twitter }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.socialMedium.fields.tiktok') }}
                        </th>
                        <td>
                            {{ $socialMedium->tiktok }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.socialMedium.fields.linkind') }}
                        </th>
                        <td>
                            {{ $socialMedium->linkind }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.social-media.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection