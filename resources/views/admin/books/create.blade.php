@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.book.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.books.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.book.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.book.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="author">{{ trans('cruds.book.fields.author') }}</label>
                <input class="form-control {{ $errors->has('author') ? 'is-invalid' : '' }}" type="text" name="author" id="author" value="{{ old('author', '') }}" required>
                @if($errors->has('author'))
                    <div class="invalid-feedback">
                        {{ $errors->first('author') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.book.fields.author_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="genres_id">{{ trans('cruds.book.fields.genres') }}</label>
                <select class="form-control select2 {{ $errors->has('genres') ? 'is-invalid' : '' }}" name="genres_id" id="genres_id" required>
                    @foreach($genres as $id => $entry)
                        <option value="{{ $id }}" {{ old('genres_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('genres'))
                    <div class="invalid-feedback">
                        {{ $errors->first('genres') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.book.fields.genres_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="notes_and_description">{{ trans('cruds.book.fields.notes_and_description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('notes_and_description') ? 'is-invalid' : '' }}" name="notes_and_description" id="notes_and_description">{!! old('notes_and_description') !!}</textarea>
                @if($errors->has('notes_and_description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('notes_and_description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.book.fields.notes_and_description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.book.fields.language') }}</label>
                <select class="form-control {{ $errors->has('language') ? 'is-invalid' : '' }}" name="language" id="language" required>
                    <option value disabled {{ old('language', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Book::LANGUAGE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('language', 'English') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('language'))
                    <div class="invalid-feedback">
                        {{ $errors->first('language') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.book.fields.language_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="isbn">{{ trans('cruds.book.fields.isbn') }}</label>
                <input class="form-control {{ $errors->has('isbn') ? 'is-invalid' : '' }}" type="text" name="isbn" id="isbn" value="{{ old('isbn', '') }}">
                @if($errors->has('isbn'))
                    <div class="invalid-feedback">
                        {{ $errors->first('isbn') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.book.fields.isbn_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="publisher">{{ trans('cruds.book.fields.publisher') }}</label>
                <input class="form-control {{ $errors->has('publisher') ? 'is-invalid' : '' }}" type="text" name="publisher" id="publisher" value="{{ old('publisher', '') }}">
                @if($errors->has('publisher'))
                    <div class="invalid-feedback">
                        {{ $errors->first('publisher') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.book.fields.publisher_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="status_id">{{ trans('cruds.book.fields.status') }}</label>
                <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status_id" id="status_id" required>
                    @foreach($statuses as $id => $entry)
                        <option value="{{ $id }}" {{ old('status_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.book.fields.status_helper') }}</span>
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
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('admin.books.storeCKEditorImages') }}', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $book->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

@endsection