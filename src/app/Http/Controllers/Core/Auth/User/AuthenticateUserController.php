<?php

namespace App\Http\Controllers\Core\Auth\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthenticateUserController extends Controller
{
    public function show()
    {
        return auth()->user()->load('roles:id,name', 'profile:id,user_id,gender,marital_status,number_of_children,nationality,religion_id,ethnicity_id,date_of_birth,address,contact', 'profilePicture', 'status:id,name,class');
    }
}
