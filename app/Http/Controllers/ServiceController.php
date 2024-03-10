<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use DB;
use View;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return View::make('services.indexAdmin', compact('services'));

        // $services = DB::table('services')->get();
        // return View::make('services.indexAdmin', compact('services'));
    }
}
