<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Deviceservice;
use DB;
use View;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = DB::table('services')->get();
        return View::make('serviceAdmin.adminIndex', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $device_id = $request->id;
        return view::make('services.create', compact('device_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $device = Device::where('device_id', $request->device_id)->value('device_type');

        $services = new Service();
        $services->service_type = $request->service_type;
        $services->save();

        $deviceservice = new Deviceservice();
        $deviceservice->device_id = $request->device_id;
        $deviceservice->device_type = $device;
        $deviceservice->service_id = $services->service_id;
        $deviceservice->service_type = $request->service_type;
        $deviceservice->save();
        return redirect()->route('deviceservices.index', $request->device_id)->with('success', 'Service created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($service)
    {
        $service = Service::where('service_id', $service)->first();
        return View::make('services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $service = Service::where('service_id', $id)->update([
            'service_type' => $request->service_type,       
        ]);

        $device_service = Deviceservice::where('service_id', $id)->update([
            'service_type' => $request->service_type,       
        ]);

        $device_id = Deviceservice::where('service_id', $id)->value('device_id');
        return redirect()->route('deviceservices.index', $device_id)->with('success', 'Service updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $device_id = Deviceservice::where('service_id', $service->service_id)->value('device_id');
        $service->delete();
        return redirect()->route('deviceservices.index', $device_id)->with('success', 'Service updated successfully.');
    }
}
