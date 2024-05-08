<?php

namespace App\Http\Resources;

use App\Http\Resources\BaseResource;
use Carbon\Carbon;

class UserResource extends BaseResource
{
    protected $tokenIncluded = false;

    /**
     * UserResource constructor.
     * @param $resource
     * @param bool $tokenIncluded
     */
    public function __construct($resource, $tokenIncluded = false)
    {
        parent::__construct($resource);
        $this->tokenIncluded = $tokenIncluded;
    }
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data = [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'date_of_birth' => $this->dob != null ? (new Carbon($this->dob))->format('d/m/Y') : '',
            'gender' => $this->genderName,
        ];

        if ($this->tokenIncluded) {
            $data['token'] = $this->createToken('API Token')->accessToken;
        }

        return $data;
    }

}
