<?php

namespace App\Services\Facades;

use App\Helper\_RuleHelper;
use App\Http\Resources\TimesheetResource;
use App\Models\Timesheet;
use App\Services\Interfaces\ITimesheet;
use Illuminate\Http\Request;

class Ftimesheet implements ITimesheet
{
    public function index(Request $request)
    {
        $query = Timesheet::query();
        $filters = $request->all();
        if (!empty($filters)) {
            foreach ($filters as $key => $filter) {
                $query->where($key, 'LIKE', "%$filter%");
            }
        }
        return $query->paginate();
    }

    public function show($id)
    {
        $timesheet = Timesheet::query()->findOrFail($id);
        return new TimesheetResource($timesheet);
    }

    public function store(Request $request)
    {
        $rulues = _RuleHelper::getRule('timesheet_rules');
        $request->validate($rulues);
        $timesheet = Timesheet::create([
            'task_name' => $request->name,
            'project_id' => $request->project_id,
            'user_id' => $request->user_id,
            'timesheet_date' => $request->date,
            'timesheet_hours' => $request->hours,
        ]);
        return $timesheet;
    }

    public function update($id, Request $request)
    {
        $rulues = _RuleHelper::getRule('timesheet_rules');
        $request->validate($rulues);
        $timesheet = Timesheet::query()->findOrFail($id);
        $timesheet->update([
            'task_name' => $request->name,
            'project_id' => $request->project_id,
            'user_id' => $request->user_id,
            'timesheet_date' => $request->date,
            'timesheet_hours' => $request->hours,
        ]);
        return $timesheet;
    }

    public function destroy($id)
    {
        $timesheet = Timesheet::query()->findOrFail($id);
        return  $timesheet->delete();
    }
}
