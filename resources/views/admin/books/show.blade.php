@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.book.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.books.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.book.fields.id') }}
                        </th>
                        <td>
                            {{ $book->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.book.fields.title') }}
                        </th>
                        <td>
                            {{ $book->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.book.fields.author') }}
                        </th>
                        <td>
                            {{ $book->author }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.book.fields.genres') }}
                        </th>
                        <td>
                            {{ $book->genres->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.book.fields.notes_and_description') }}
                        </th>
                        <td>
                            {!! $book->notes_and_description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.book.fields.language') }}
                        </th>
                        <td>
                            {{ App\Models\Book::LANGUAGE_SELECT[$book->language] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.book.fields.isbn') }}
                        </th>
                        <td>
                            {{ $book->isbn }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.book.fields.publisher') }}
                        </th>
                        <td>
                            {{ $book->publisher }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.book.fields.status') }}
                        </th>
                        <td>
                            {{ $book->status->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.books.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection