<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BaseResource;
use App\Http\Resources\TimesheetResource;
use App\Services\Interfaces\ITimesheet;
use Exception;
use Illuminate\Http\Request;

class TimesheetController extends Controller
{
    protected ITimesheet $timesheet;

    public function __construct(ITimesheet $timesheet)
    {
        $this->timesheet = $timesheet;
    }
    public function index(Request $request)
    {
        try {
            return $this->timesheet->index($request);
        } catch (Exception $e) {
            return TimesheetResource::exception($e);
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
            $res = $this->timesheet->store($request);
            if ($res) {
                return new TimesheetResource($res);
            }
            return BaseResource::return();
        } catch (Exception $e) {
            return TimesheetResource::exception($e);
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
            $res = $this->timesheet->show($id);
            if ($res) {
                return new TimesheetResource($res);
            }
            return BaseResource::return();
        } catch (Exception $e) {
            return TimesheetResource::exception($e);
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
            $res = $this->timesheet->update($id, $request);
            if ($res) {
                return new TimesheetResource($res);
            }
            return BaseResource::return();
        } catch (Exception $e) {
            return TimesheetResource::exception($e);
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
            $res = $this->timesheet->destroy($id);
            if ($res) {
                return BaseResource::ok("Deleted successfully");
            }
            return BaseResource::return();
        } catch (Exception $e) {
            return TimesheetResource::exception($e);
        }
    }
}
