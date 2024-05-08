<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BaseResource;
use App\Http\Resources\ProjectResource;
use App\Services\Interfaces\IProject;
use Exception;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    protected IProject $project;

    public function __construct(IProject $project)
    {
        $this->project = $project;
    }
    public function index(Request $request)
    {
        try {
            return $this->project->index($request);
        } catch (Exception $e) {
            return ProjectResource::exception($e);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $res = $this->project->store($request);
            if ($res) {
                return new ProjectResource($res);
            }
            return BaseResource::return();
        } catch (Exception $e) {
            return ProjectResource::exception($e);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $res = $this->project->show($id);
            if ($res) {
                return new ProjectResource($res);
            }
            return BaseResource::return();
        } catch (Exception $e) {
            return ProjectResource::exception($e);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $res = $this->project->update($id, $request);
            if ($res) {
                return new ProjectResource($res);
            }
            return BaseResource::return();
        } catch (Exception $e) {
            return ProjectResource::exception($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $res = $this->project->destroy($id);
            if ($res) {
                return BaseResource::ok("Deleted successfully");
            }
            return BaseResource::return();
        } catch (Exception $e) {
            return ProjectResource::exception($e);
        }
    }
}
