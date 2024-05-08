<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

use function PHPUnit\Framework\returnSelf;

class Project extends Model
{
    use  HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'department_id',
        'start_date',
        'end_date',
        'status',
    ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function timesheets(): HasMany
    {
        return $this->hasMany(Timesheet::class);
    }

    public function users(): HasManyThrough
    {
        return $this->hasManyThrough(User::class, 'user_project');
    }

    public function getStatusNameAttribute()
    {
        switch ($this->status) {
            case 1:
                return "Pending";
            case 2:
                return "Ongoing";
            case 3:
                return "Complete";
            case 4:
                return "Canceled";
            default:
                return "Unknown";
        }
    }
}
