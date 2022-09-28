@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.personalizedOne.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.personalized-ones.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.personalizedOne.fields.id') }}
                        </th>
                        <td>
                            {{ $personalizedOne->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.personalizedOne.fields.tittle_banner') }}
                        </th>
                        <td>
                            {{ $personalizedOne->tittle_banner }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.personalizedOne.fields.products') }}
                        </th>
                        <td>
                            {{ $personalizedOne->products->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.personalizedOne.fields.discount') }}
                        </th>
                        <td>
                            {{ $personalizedOne->discount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.personalizedOne.fields.image') }}
                        </th>
                        <td>
                            @if($personalizedOne->image)
                                <a href="{{ $personalizedOne->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $personalizedOne->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.personalized-ones.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection