@can('book_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.books.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.book.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.book.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-genresBooks">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.book.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.book.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.book.fields.author') }}
                        </th>
                        <th>
                            {{ trans('cruds.book.fields.genres') }}
                        </th>
                        <th>
                            {{ trans('cruds.book.fields.language') }}
                        </th>
                        <th>
                            {{ trans('cruds.book.fields.isbn') }}
                        </th>
                        <th>
                            {{ trans('cruds.book.fields.publisher') }}
                        </th>
                        <th>
                            {{ trans('cruds.book.fields.status') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($books as $key => $book)
                        <tr data-entry-id="{{ $book->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $book->id ?? '' }}
                            </td>
                            <td>
                                {{ $book->title ?? '' }}
                            </td>
                            <td>
                                {{ $book->author ?? '' }}
                            </td>
                            <td>
                                {{ $book->genres->title ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Book::LANGUAGE_SELECT[$book->language] ?? '' }}
                            </td>
                            <td>
                                {{ $book->isbn ?? '' }}
                            </td>
                            <td>
                                {{ $book->publisher ?? '' }}
                            </td>
                            <td>
                                {{ $book->status->name ?? '' }}
                            </td>
                            <td>
                                @can('book_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.books.show', $book->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('book_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.books.edit', $book->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('book_delete')
                                    <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('book_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.books.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 50,
  });
  let table = $('.datatable-genresBooks:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection