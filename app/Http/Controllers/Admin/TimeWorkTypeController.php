<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTimeWorkTypeRequest;
use App\Http\Requests\StoreTimeWorkTypeRequest;
use App\Http\Requests\UpdateTimeWorkTypeRequest;
use App\Models\TimeWorkType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TimeWorkTypeController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('time_work_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = TimeWorkType::with(['created_by'])->select(sprintf('%s.*', (new TimeWorkType)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'time_work_type_show';
                $editGate      = 'time_work_type_edit';
                $deleteGate    = 'time_work_type_delete';
                $crudRoutePart = 'time-work-types';

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

        return view('admin.timeWorkTypes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('time_work_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.timeWorkTypes.create');
    }

    public function store(StoreTimeWorkTypeRequest $request)
    {
        $timeWorkType = TimeWorkType::create($request->all());

        return redirect()->route('admin.time-work-types.index');
    }

    public function edit(TimeWorkType $timeWorkType)
    {
        abort_if(Gate::denies('time_work_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $timeWorkType->load('created_by');

        return view('admin.timeWorkTypes.edit', compact('timeWorkType'));
    }

    public function update(UpdateTimeWorkTypeRequest $request, TimeWorkType $timeWorkType)
    {
        $timeWorkType->update($request->all());

        return redirect()->route('admin.time-work-types.index');
    }

    public function show(TimeWorkType $timeWorkType)
    {
        abort_if(Gate::denies('time_work_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $timeWorkType->load('created_by');

        return view('admin.timeWorkTypes.show', compact('timeWorkType'));
    }

    public function destroy(TimeWorkType $timeWorkType)
    {
        abort_if(Gate::denies('time_work_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $timeWorkType->delete();

        return back();
    }

    public function massDestroy(MassDestroyTimeWorkTypeRequest $request)
    {
        $timeWorkTypes = TimeWorkType::find(request('ids'));

        foreach ($timeWorkTypes as $timeWorkType) {
            $timeWorkType->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
