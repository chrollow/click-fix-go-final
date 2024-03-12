<!-- resources/views/suppliers/edit.blade.php -->

@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Edit Technician</h1>

    @if($errors->any())
    <div>
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="post" action="{{ route('technicians.update')}}">

        @csrf
        @method('PUT')

        <div>
            <label for="supplier_name">Technician Name</label>
            <input type="text" id="supplier_name" name="technician_name" value="{{ $technician->technician_name }}" placeholder="Technician Name"/>
            <input type="hidden" name="technician_id" value="{{ $technician->technician_id }}">
        </div>

        <div>
            <label for="supplier_email">Technician Email</label>
            <input type="email" id="supplier_email" name="email" value="{{ $technician->email }}" placeholder="Technician Email"/>
        </div>

        <div>
            <label for="contact_number">Phone Number</label>
            <input type="text" id="contact_number" name="phone_number" value="{{ $technician->phone_number }}" placeholder="Phone Number"/>
        </div>

        <div>
            <label for="address">Specialty</label>
            <select id="specialty_type" name="specialty_id">
                <option value="">Select Specialty</option>
                @foreach($specialties as $specialty)
                    <option value="{{ $specialty->specialty_id }}">{{ $specialty->specialty_type }}</option>
                @endforeach
                <!-- Add more options as needed -->
            </select>
        </div>

        <div>
            <button type="submit">Update</button>
        </div>
    </form>
</div>
@endsection
