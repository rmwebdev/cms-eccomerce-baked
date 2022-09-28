@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.settingContent.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.setting-contents.update", [$settingContent->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="tag_line_product">{{ trans('cruds.settingContent.fields.tag_line_product') }}</label>
                <input class="form-control {{ $errors->has('tag_line_product') ? 'is-invalid' : '' }}" type="text" name="tag_line_product" id="tag_line_product" value="{{ old('tag_line_product', $settingContent->tag_line_product) }}">
                @if($errors->has('tag_line_product'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tag_line_product') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.settingContent.fields.tag_line_product_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="product_image">{{ trans('cruds.settingContent.fields.product_image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('product_image') ? 'is-invalid' : '' }}" id="product_image-dropzone">
                </div>
                @if($errors->has('product_image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('product_image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.settingContent.fields.product_image_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="thumbnail_video">{{ trans('cruds.settingContent.fields.thumbnail_video') }}</label>
                <div class="needsclick dropzone {{ $errors->has('thumbnail_video') ? 'is-invalid' : '' }}" id="thumbnail_video-dropzone">
                </div>
                @if($errors->has('thumbnail_video'))
                    <div class="invalid-feedback">
                        {{ $errors->first('thumbnail_video') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.settingContent.fields.thumbnail_video_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="url_video">{{ trans('cruds.settingContent.fields.url_video') }}</label>
                <input class="form-control {{ $errors->has('url_video') ? 'is-invalid' : '' }}" type="text" name="url_video" id="url_video" value="{{ old('url_video', $settingContent->url_video) }}">
                @if($errors->has('url_video'))
                    <div class="invalid-feedback">
                        {{ $errors->first('url_video') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.settingContent.fields.url_video_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="video">{{ trans('cruds.settingContent.fields.video') }}</label>
                <div class="needsclick dropzone {{ $errors->has('video') ? 'is-invalid' : '' }}" id="video-dropzone">
                </div>
                @if($errors->has('video'))
                    <div class="invalid-feedback">
                        {{ $errors->first('video') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.settingContent.fields.video_helper') }}</span>
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
    Dropzone.options.productImageDropzone = {
    url: '{{ route('admin.setting-contents.storeMedia') }}',
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
      $('form').find('input[name="product_image"]').remove()
      $('form').append('<input type="hidden" name="product_image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="product_image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($settingContent) && $settingContent->product_image)
      var file = {!! json_encode($settingContent->product_image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="product_image" value="' + file.file_name + '">')
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
    Dropzone.options.thumbnailVideoDropzone = {
    url: '{{ route('admin.setting-contents.storeMedia') }}',
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
      $('form').find('input[name="thumbnail_video"]').remove()
      $('form').append('<input type="hidden" name="thumbnail_video" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="thumbnail_video"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($settingContent) && $settingContent->thumbnail_video)
      var file = {!! json_encode($settingContent->thumbnail_video) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="thumbnail_video" value="' + file.file_name + '">')
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
    Dropzone.options.videoDropzone = {
    url: '{{ route('admin.setting-contents.storeMedia') }}',
    maxFilesize: 25, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 25
    },
    success: function (file, response) {
      $('form').find('input[name="video"]').remove()
      $('form').append('<input type="hidden" name="video" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="video"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($settingContent) && $settingContent->video)
      var file = {!! json_encode($settingContent->video) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="video" value="' + file.file_name + '">')
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