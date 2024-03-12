<?php

namespace App\Http\Controllers;

use App\Models\Technician;
use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;

class TechnicianController extends Controller
{
    public function index()
    {
        $technicians = DB::table('technicians')->get();
        return View::make('technicians.index', compact('technicians'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $userId = $request->userId;
        $email = $request->email;
        $name = $request->name;
        return View::make('technicians.create',  ['userId' => $userId, 'email' => $email, 'name' => $name]);
    }

    public function register(){
        return View::make('technicians.register');
    }

    public function registerStore(Request $request){
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->user,
            'password' => Hash::make($request->password),
        ]);

        $technician = Technician::create([
            'user_id' => $user->id,
            'technician_name' => $request->name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
        ]);

        return redirect()->route('technicians.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'image' => 'mimes:jpg,bmp,png',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $path = Storage::putFileAs(
            'public/images/devices',
            $request->file('image'),
            $request->file('image')->getClientOriginalName()
        );

        $device = new Device();
        $device->device_type = $request->device_type;
        $device->image = 'storage/images/devices/' . $request->file('image')->getClientOriginalName();
        $device->save();
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
    public function edit($id)
    {
        $device = Device::where('device_id', $id)->first();
        return View::make('devices.edit', compact('device'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'image' => 'mimes:jpg,bmp,png',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) 
        {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }else if ($request->file('image')) 
        {
            $path = Storage::putFileAs(
                'public/images/devices',
                $request->file('image'),
                $request->file('image')->getClientOriginalName()
            );

            $device = Device::where('device_id', $id)->update([
                'device_type' => $request->device_type,
                'image' => 'storage/images/devices/' . $request->file('image')->getClientOriginalName()
            ]);
        }else{
            $device = Device::where('device_id', $id)->update([
                'device_type' => $request->device_type,
            ]);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function indexAdmin()
    {
        $types = DB::table('devices')->get();
        return View::make('devices.index', compact('types'));
    }
}
