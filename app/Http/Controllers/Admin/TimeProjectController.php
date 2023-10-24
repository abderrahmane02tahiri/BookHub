<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTimeProjectRequest;
use App\Http\Requests\StoreTimeProjectRequest;
use App\Http\Requests\UpdateTimeProjectRequest;
use App\Models\TimeProject;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TimeProjectController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('time_project_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = TimeProject::with(['created_by'])->select(sprintf('%s.*', (new TimeProject)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'time_project_show';
                $editGate      = 'time_project_edit';
                $deleteGate    = 'time_project_delete';
                $crudRoutePart = 'time-projects';

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

        return view('admin.timeProjects.index');
    }

    public function create()
    {
        abort_if(Gate::denies('time_project_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.timeProjects.create');
    }

    public function store(StoreTimeProjectRequest $request)
    {
        $timeProject = TimeProject::create($request->all());

        return redirect()->route('admin.time-projects.index');
    }

    public function edit(TimeProject $timeProject)
    {
        abort_if(Gate::denies('time_project_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $timeProject->load('created_by');

        return view('admin.timeProjects.edit', compact('timeProject'));
    }

    public function update(UpdateTimeProjectRequest $request, TimeProject $timeProject)
    {
        $timeProject->update($request->all());

        return redirect()->route('admin.time-projects.index');
    }

    public function show(TimeProject $timeProject)
    {
        abort_if(Gate::denies('time_project_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $timeProject->load('created_by');

        return view('admin.timeProjects.show', compact('timeProject'));
    }

    public function destroy(TimeProject $timeProject)
    {
        abort_if(Gate::denies('time_project_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $timeProject->delete();

        return back();
    }

    public function massDestroy(MassDestroyTimeProjectRequest $request)
    {
        $timeProjects = TimeProject::find(request('ids'));

        foreach ($timeProjects as $timeProject) {
            $timeProject->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
