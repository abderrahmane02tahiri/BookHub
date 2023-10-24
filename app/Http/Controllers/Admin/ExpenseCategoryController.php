<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyExpenseCategoryRequest;
use App\Http\Requests\StoreExpenseCategoryRequest;
use App\Http\Requests\UpdateExpenseCategoryRequest;
use App\Models\ExpenseCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ExpenseCategoryController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('expense_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ExpenseCategory::with(['created_by'])->select(sprintf('%s.*', (new ExpenseCategory)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'expense_category_show';
                $editGate      = 'expense_category_edit';
                $deleteGate    = 'expense_category_delete';
                $crudRoutePart = 'expense-categories';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.expenseCategories.index');
    }

    public function create()
    {
        abort_if(Gate::denies('expense_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.expenseCategories.create');
    }

    public function store(StoreExpenseCategoryRequest $request)
    {
        $expenseCategory = ExpenseCategory::create($request->all());

        return redirect()->route('admin.expense-categories.index');
    }

    public function edit(ExpenseCategory $expenseCategory)
    {
        abort_if(Gate::denies('expense_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $expenseCategory->load('created_by');

        return view('admin.expenseCategories.edit', compact('expenseCategory'));
    }

    public function update(UpdateExpenseCategoryRequest $request, ExpenseCategory $expenseCategory)
    {
        $expenseCategory->update($request->all());

        return redirect()->route('admin.expense-categories.index');
    }

    public function show(ExpenseCategory $expenseCategory)
    {
        abort_if(Gate::denies('expense_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $expenseCategory->load('created_by');

        return view('admin.expenseCategories.show', compact('expenseCategory'));
    }

    public function destroy(ExpenseCategory $expenseCategory)
    {
        abort_if(Gate::denies('expense_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $expenseCategory->delete();

        return back();
    }

    public function massDestroy(MassDestroyExpenseCategoryRequest $request)
    {
        $expenseCategories = ExpenseCategory::find(request('ids'));

        foreach ($expenseCategories as $expenseCategory) {
            $expenseCategory->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
