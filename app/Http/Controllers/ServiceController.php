<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = DB::table('services')->get();
        return View::make('serviceAdmin.adminIndex', compact('services'));
    }
}
