<?php

namespace App\Http\Resources;

use App\Http\Resources\BaseResource;
use Carbon\Carbon;

class ProjectResource extends BaseResource
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
            'start_date' => $this->start_date != null ? (new Carbon($this->start_date))->format('d/m/Y') : '',
            'end_date' => $this->end_date != null ? (new Carbon($this->end_date))->format('d/m/Y') : '',
            'status' => $this->stautsName,
        ];
    }

}
