<?php

namespace App\Models\Core\Auth;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['user_id', 'gender', 'marital_status', 'number_of_children', 'nationality', 'religion_id', 'ethnicity_id', 'date_of_birth', 'address', 'contact'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
