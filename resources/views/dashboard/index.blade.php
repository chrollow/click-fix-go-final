@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center my-4">We Repair and Clean It All!</h1>
    <p class="text-center mb-5">Choose your option to manage:</p>
    <div class="row">
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="blue card help-button rounded-4 p-2">
                <div class="card-body">
                    <h3 class="card-title">CRUD Devices</h3>
                    <p class="card-text">Manage devices with CRUD operations</p>
                    <a href="/devices/index" class="btn btn-primary">Manage Devices</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="blue card help-button rounded-4 p-2">
                <div class="card-body">
                    <h3 class="card-title">CRUD Services</h3>
                    <p class="card-text">Manage services with CRUD operations</p>
                    <a href="/services/index" class="btn btn-primary">Manage Services</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="blue card help-button rounded-4 p-2">
                <div class="card-body">
                    <h3 class="card-title">Manage Tickets</h3>
                    <p class="card-text">Manage upcoming, fixing, and finished tickets</p>
                    <a href="/queues/index" class="btn btn-primary">Manage Tickets</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="blue card help-button rounded-4 p-2">
                <div class="card-body">
                    <h3 class="card-title">Manage Supplies</h3>
                    <p class="card-text">Manage supplies with CRUD operations</p>
                    <a href="/supplies/index" class="btn btn-primary">Manage Supplies</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="blue card help-button rounded-4 p-2">
                <div class="card-body">
                    <h3 class="card-title">Manage Suppliers</h3>
                    <p class="card-text">Manage suppliers with CRUD operations</p>
                    <a href="/suppliers/index" class="btn btn-primary">Manage Suppliers</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="blue card help-button rounded-4 p-2">
                <div class="card-body">
                    <h3 class="card-title">Manage Technicians</h3>
                    <p class="card-text">Manage technicians with CRUD operations</p>
                    <a href="/technicians/index" class="btn btn-primary">Manage Technicians</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
