<?php

namespace App\Models\Tenant\Employee;

use App\Models\Core\Auth\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWorkExperience extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'user_id', 'value'];
    protected $table = 'user_work_experiences';

    protected $dates = [
        'start_date', 'end_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getValueAttribute()
    {
        if (in_array($this->key, ['employee_work_experiences'])) {
            return json_decode($this->attributes['value']);
        }

        return $this->attributes['value'];
    }
}
