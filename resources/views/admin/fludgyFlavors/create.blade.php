@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.fludgyFlavor.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.fludgy-flavors.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="banner_tittle">{{ trans('cruds.fludgyFlavor.fields.banner_tittle') }}</label>
                <input class="form-control {{ $errors->has('banner_tittle') ? 'is-invalid' : '' }}" type="text" name="banner_tittle" id="banner_tittle" value="{{ old('banner_tittle', '12 Fudgy Flavours in 3 Sizes') }}">
                @if($errors->has('banner_tittle'))
                    <div class="invalid-feedback">
                        {{ $errors->first('banner_tittle') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fludgyFlavor.fields.banner_tittle_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="product_id">{{ trans('cruds.fludgyFlavor.fields.product') }}</label>
                <select class="form-control select2 {{ $errors->has('product') ? 'is-invalid' : '' }}" name="product_id" id="product_id" required>
                    @foreach($products as $id => $entry)
                        <option value="{{ $id }}" {{ old('product_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('product'))
                    <div class="invalid-feedback">
                        {{ $errors->first('product') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fludgyFlavor.fields.product_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection