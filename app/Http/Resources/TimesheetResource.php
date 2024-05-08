<?php

namespace App\Http\Resources;

use App\Http\Resources\BaseResource;
use Carbon\Carbon;

class TimesheetResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'department' => $this->department->name,
            'date' => $this->timesheet_date != null ? (new Carbon($this->start_date))->format('d/m/Y') : '',
            'hours' => $this->timesheet_hours ?? 0,
            'project' => [
                'id' => $this->project->id,
                'name' => $this->project->name,
            ],
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->first_name . ' ' . $this->user->last_name,
            ],
        ];
    }
}
