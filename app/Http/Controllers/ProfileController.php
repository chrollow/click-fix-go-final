<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show()
    {
        // You can pass any data you need to the profile view here
        return view('profile.profile');
    }
}