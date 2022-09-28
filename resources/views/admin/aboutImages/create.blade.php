@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.aboutImage.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.about-images.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.aboutImage.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.aboutImage.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="sub_tittle">{{ trans('cruds.aboutImage.fields.sub_tittle') }}</label>
                <input class="form-control {{ $errors->has('sub_tittle') ? 'is-invalid' : '' }}" type="text" name="sub_tittle" id="sub_tittle" value="{{ old('sub_tittle', '') }}" required>
                @if($errors->has('sub_tittle'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sub_tittle') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.aboutImage.fields.sub_tittle_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="img_one">{{ trans('cruds.aboutImage.fields.img_one') }}</label>
                <div class="needsclick dropzone {{ $errors->has('img_one') ? 'is-invalid' : '' }}" id="img_one-dropzone">
                </div>
                @if($errors->has('img_one'))
                    <div class="invalid-feedback">
                        {{ $errors->first('img_one') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.aboutImage.fields.img_one_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="img_two">{{ trans('cruds.aboutImage.fields.img_two') }}</label>
                <div class="needsclick dropzone {{ $errors->has('img_two') ? 'is-invalid' : '' }}" id="img_two-dropzone">
                </div>
                @if($errors->has('img_two'))
                    <div class="invalid-feedback">
                        {{ $errors->first('img_two') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.aboutImage.fields.img_two_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="img_tree">{{ trans('cruds.aboutImage.fields.img_tree') }}</label>
                <div class="needsclick dropzone {{ $errors->has('img_tree') ? 'is-invalid' : '' }}" id="img_tree-dropzone">
                </div>
                @if($errors->has('img_tree'))
                    <div class="invalid-feedback">
                        {{ $errors->first('img_tree') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.aboutImage.fields.img_tree_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="img_four">{{ trans('cruds.aboutImage.fields.img_four') }}</label>
                <div class="needsclick dropzone {{ $errors->has('img_four') ? 'is-invalid' : '' }}" id="img_four-dropzone">
                </div>
                @if($errors->has('img_four'))
                    <div class="invalid-feedback">
                        {{ $errors->first('img_four') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.aboutImage.fields.img_four_helper') }}</span>
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

@section('scripts')
<script>
    Dropzone.options.imgOneDropzone = {
    url: '{{ route('admin.about-images.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="img_one"]').remove()
      $('form').append('<input type="hidden" name="img_one" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="img_one"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($aboutImage) && $aboutImage->img_one)
      var file = {!! json_encode($aboutImage->img_one) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="img_one" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}

</script>
<script>
    Dropzone.options.imgTwoDropzone = {
    url: '{{ route('admin.about-images.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="img_two"]').remove()
      $('form').append('<input type="hidden" name="img_two" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="img_two"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($aboutImage) && $aboutImage->img_two)
      var file = {!! json_encode($aboutImage->img_two) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="img_two" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}

</script>
<script>
    Dropzone.options.imgTreeDropzone = {
    url: '{{ route('admin.about-images.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="img_tree"]').remove()
      $('form').append('<input type="hidden" name="img_tree" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="img_tree"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($aboutImage) && $aboutImage->img_tree)
      var file = {!! json_encode($aboutImage->img_tree) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="img_tree" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}

</script>
<script>
    Dropzone.options.imgFourDropzone = {
    url: '{{ route('admin.about-images.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="img_four"]').remove()
      $('form').append('<input type="hidden" name="img_four" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="img_four"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($aboutImage) && $aboutImage->img_four)
      var file = {!! json_encode($aboutImage->img_four) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="img_four" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}

</script>
@endsection