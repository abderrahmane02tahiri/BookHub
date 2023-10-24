<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTimeEntryRequest;
use App\Http\Requests\StoreTimeEntryRequest;
use App\Http\Requests\UpdateTimeEntryRequest;
use App\Models\TimeEntry;
use App\Models\TimeProject;
use App\Models\TimeWorkType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TimeEntryController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('time_entry_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $timeEntries = TimeEntry::with(['work_type', 'project'])->get();

        return view('admin.timeEntries.index', compact('timeEntries'));
    }

    public function create()
    {
        abort_if(Gate::denies('time_entry_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $work_types = TimeWorkType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $projects = TimeProject::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.timeEntries.create', compact('projects', 'work_types'));
    }

    public function store(StoreTimeEntryRequest $request)
    {
        $timeEntry = TimeEntry::create($request->all());

        return redirect()->route('admin.time-entries.index');
    }

    public function edit(TimeEntry $timeEntry)
    {
        abort_if(Gate::denies('time_entry_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $work_types = TimeWorkType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $projects = TimeProject::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $timeEntry->load('work_type', 'project');

        return view('admin.timeEntries.edit', compact('projects', 'timeEntry', 'work_types'));
    }

    public function update(UpdateTimeEntryRequest $request, TimeEntry $timeEntry)
    {
        $timeEntry->update($request->all());

        return redirect()->route('admin.time-entries.index');
    }

    public function show(TimeEntry $timeEntry)
    {
        abort_if(Gate::denies('time_entry_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $timeEntry->load('work_type', 'project');

        return view('admin.timeEntries.show', compact('timeEntry'));
    }

    public function destroy(TimeEntry $timeEntry)
    {
        abort_if(Gate::denies('time_entry_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $timeEntry->delete();

        return back();
    }

    public function massDestroy(MassDestroyTimeEntryRequest $request)
    {
        $timeEntries = TimeEntry::find(request('ids'));

        foreach ($timeEntries as $timeEntry) {
            $timeEntry->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
