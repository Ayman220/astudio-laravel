<?php

namespace App\Services\Facades;

use App\Helper\_RuleHelper;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Models\User;
use App\Services\Interfaces\IProject;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FProject implements IProject
{
    public function index(Request $request)
    {
        $query = Project::query();
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
        $project = Project::query()->findOrFail($id);
        return new ProjectResource($project);
    }

    public function store(Request $request)
    {
        $rulues = _RuleHelper::getRule('project_rules');
        $request->validate($rulues);
        $project = Project::create([
            'name' => $request->name,
            'department_id' => $request->department_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
        ]);
        return $project;
    }

    public function update($id, Request $request)
    {
        $rulues = _RuleHelper::getRule('project_rules');
        $request->validate($rulues);
        $project = Project::query()->findOrFail($id);
        $project->update([
            'name' => $request->name,
            'department_id' => $request->department_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
        ]);
        return $project;
    }

    public function destroy($id)
    {
        $project = Project::query()->findOrFail($id);
        try {
            DB::beginTransaction();
            $project->timesheets()->delete();
            $project->delete();
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw ($e);
        }
    }
}
