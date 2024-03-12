<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\User;
use App\Models\Device;
use App\Models\Technician;
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
            'specialty_id' => $request->specialty_id,
            'specialty_type' => $request->specialty_type,
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
        $specialties = DB::table('specialties')->get();
        $technician = Technician::where('technician_id', $id)->first();
        return View::make('technicians.edit', compact('technician', 'specialties'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'supplier_name' => 'required|string|max:255',
            'supplier_email' => 'required|email',
            'contact_number' => 'required|string|max:20',
            'address' => 'required|string|max:255',
        ]);
    
        // Update the supplier with validated data
        $supplier->update($validatedData);
    
        // Redirect back with success message
        return redirect()->route('suppliers.index')->with('success', 'Supplier updated successfully.');
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
