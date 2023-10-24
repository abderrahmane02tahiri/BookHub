<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBookGenresAndCategoryRequest;
use App\Http\Requests\StoreBookGenresAndCategoryRequest;
use App\Http\Requests\UpdateBookGenresAndCategoryRequest;
use App\Models\BookGenresAndCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BookGenresAndCategoriesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('book_genres_and_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = BookGenresAndCategory::with(['created_by'])->select(sprintf('%s.*', (new BookGenresAndCategory)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'book_genres_and_category_show';
                $editGate      = 'book_genres_and_category_edit';
                $deleteGate    = 'book_genres_and_category_delete';
                $crudRoutePart = 'book-genres-and-categories';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.bookGenresAndCategories.index');
    }

    public function create()
    {
        abort_if(Gate::denies('book_genres_and_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bookGenresAndCategories.create');
    }

    public function store(StoreBookGenresAndCategoryRequest $request)
    {
        $bookGenresAndCategory = BookGenresAndCategory::create($request->all());

        return redirect()->route('admin.book-genres-and-categories.index');
    }

    public function edit(BookGenresAndCategory $bookGenresAndCategory)
    {
        abort_if(Gate::denies('book_genres_and_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bookGenresAndCategory->load('created_by');

        return view('admin.bookGenresAndCategories.edit', compact('bookGenresAndCategory'));
    }

    public function update(UpdateBookGenresAndCategoryRequest $request, BookGenresAndCategory $bookGenresAndCategory)
    {
        $bookGenresAndCategory->update($request->all());

        return redirect()->route('admin.book-genres-and-categories.index');
    }

    public function show(BookGenresAndCategory $bookGenresAndCategory)
    {
        abort_if(Gate::denies('book_genres_and_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bookGenresAndCategory->load('created_by', 'genresBooks');

        return view('admin.bookGenresAndCategories.show', compact('bookGenresAndCategory'));
    }

    public function destroy(BookGenresAndCategory $bookGenresAndCategory)
    {
        abort_if(Gate::denies('book_genres_and_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bookGenresAndCategory->delete();

        return back();
    }

    public function massDestroy(MassDestroyBookGenresAndCategoryRequest $request)
    {
        $bookGenresAndCategories = BookGenresAndCategory::find(request('ids'));

        foreach ($bookGenresAndCategories as $bookGenresAndCategory) {
            $bookGenresAndCategory->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
