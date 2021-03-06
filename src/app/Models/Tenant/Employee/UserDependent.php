<?php

namespace App\Models\Tenant\Employee;

use App\Models\Core\Auth\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDependent extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'user_id', 'value'];
    protected $table = 'user_dependents';

    protected $dates = [
        'date_of_birth'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getValueAttribute()
    {
        if (in_array($this->key, ['employee_dependents'])) {
            return json_decode($this->attributes['value']);
        }

        return $this->attributes['value'];
    }
}
