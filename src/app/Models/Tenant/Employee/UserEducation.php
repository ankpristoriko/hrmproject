<?php

namespace App\Models\Tenant\Employee;

use App\Models\Core\Auth\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEducation extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'user_id', 'value'];
    protected $table = 'user_educations';

    protected $dates = [
        'start_year', 'end_year'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getValueAttribute()
    {
        if (in_array($this->key, ['employee_educations'])) {
            return json_decode($this->attributes['value']);
        }

        return $this->attributes['value'];
    }
}
