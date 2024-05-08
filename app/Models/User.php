<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'dob',
        'gender',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    public function timesheets(): HasMany
    {
        return $this->hasMany(Timesheet::class);
    }

    public function projects(): HasManyThrough
    {
        return $this->hasManyThrough(Project::class, 'user_project');
    }

    public function getGenderNameAttribute()
    {
        if ($this->gender == 1) {
            return "Male";
        } else if ($this->gender == 2) {
            return "Female";
        } else if ($this->gender == 3) {
            return "Other";
        } else {
            return "Not Specified";
        }
    }
}
