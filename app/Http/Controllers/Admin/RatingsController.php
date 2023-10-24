<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRatingRequest;
use App\Http\Requests\StoreRatingRequest;
use App\Http\Requests\UpdateRatingRequest;
use App\Models\Book;
use App\Models\Rating;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class RatingsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('rating_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Rating::with(['book', 'created_by'])->select(sprintf('%s.*', (new Rating)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'rating_show';
                $editGate      = 'rating_edit';
                $deleteGate    = 'rating_delete';
                $crudRoutePart = 'ratings';

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
            $table->editColumn('stars', function ($row) {
                return $row->stars ? Rating::STARS_SELECT[$row->stars] : '';
            });
            $table->addColumn('book_title', function ($row) {
                return $row->book ? $row->book->title : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'book']);

            return $table->make(true);
        }

        return view('admin.ratings.index');
    }

    public function create()
    {
        abort_if(Gate::denies('rating_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $books = Book::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.ratings.create', compact('books'));
    }

    public function store(StoreRatingRequest $request)
    {
        $rating = Rating::create($request->all());

        return redirect()->route('admin.ratings.index');
    }

    public function edit(Rating $rating)
    {
        abort_if(Gate::denies('rating_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $books = Book::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $rating->load('book', 'created_by');

        return view('admin.ratings.edit', compact('books', 'rating'));
    }

    public function update(UpdateRatingRequest $request, Rating $rating)
    {
        $rating->update($request->all());

        return redirect()->route('admin.ratings.index');
    }

    public function show(Rating $rating)
    {
        abort_if(Gate::denies('rating_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rating->load('book', 'created_by');

        return view('admin.ratings.show', compact('rating'));
    }

    public function destroy(Rating $rating)
    {
        abort_if(Gate::denies('rating_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rating->delete();

        return back();
    }

    public function massDestroy(MassDestroyRatingRequest $request)
    {
        $ratings = Rating::find(request('ids'));

        foreach ($ratings as $rating) {
            $rating->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
