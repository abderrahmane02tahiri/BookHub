@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.rating.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.ratings.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>{{ trans('cruds.rating.fields.stars') }}</label>
                <select class="form-control {{ $errors->has('stars') ? 'is-invalid' : '' }}" name="stars" id="stars">
                    <option value disabled {{ old('stars', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Rating::STARS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('stars', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('stars'))
                    <div class="invalid-feedback">
                        {{ $errors->first('stars') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.rating.fields.stars_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="book_id">{{ trans('cruds.rating.fields.book') }}</label>
                <select class="form-control select2 {{ $errors->has('book') ? 'is-invalid' : '' }}" name="book_id" id="book_id" required>
                    @foreach($books as $id => $entry)
                        <option value="{{ $id }}" {{ old('book_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('book'))
                    <div class="invalid-feedback">
                        {{ $errors->first('book') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.rating.fields.book_helper') }}</span>
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