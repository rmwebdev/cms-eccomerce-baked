@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.whatWeHave.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.what-we-haves.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.whatWeHave.fields.id') }}
                        </th>
                        <td>
                            {{ $whatWeHave->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.whatWeHave.fields.title') }}
                        </th>
                        <td>
                            {{ $whatWeHave->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.whatWeHave.fields.description') }}
                        </th>
                        <td>
                            {{ $whatWeHave->description }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.what-we-haves.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection