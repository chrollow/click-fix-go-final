@extends('layouts.base')

@section('body')
<div class="container">
  <div class="card col-12 col-xl-10 m-auto border-0 shadow-lg">
    <div class="card-header bg-dark-blue text-light">
      {{ __('Queue Information') }}
    </div>
    <div class="card-body">
      {{-- Queue Form --}}
      {!! Form::open(['route' => 'queue.store', 'class' => 'form-control', 'method' => 'post']) !!}
      @csrf
      {{-- Hidden Inputs --}}
      {!! Form::hidden('date_placed', \Carbon\Carbon::now()) !!}
      {!! Form::hidden('customer_id', '1') !!}
      {{-- Customer Name --}}
      <div class="mb-3">
        {!! Form::label('customer_name', 'Customer Name', ['class' => 'form-label']) !!}
        {!! Form::text('customer_name', null, ['class' => 'form-control']) !!}
      </div>
      {{-- Scheduled Date --}}
      <div class="mb-3">
        {!! Form::label('scheduled_date', 'Date of Appointment', ['class' => 'form-label']) !!}
        {!! Form::date('scheduled_date', null, ['class' => 'form-control']) !!}
      </div>
      {{-- Device Services --}}
      @foreach($deviceServices as $deviceService)
      <div class="mb-3">
        {!! Form::label('device_type', 'Device Type', ['class' => 'form-label']) !!}
        {!! Form::text('device_type[]', $deviceService->device_type, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
        {!! Form::hidden('device_id', $deviceService->device_id) !!}
      </div>
      @break
      @endforeach
      {{-- Service Type --}}
      <div class="mb-3">
        {!! Form::label('service_type', 'Service Type', ['class' => 'form-label']) !!}
        @foreach($deviceServices as $deviceService)
        <div class="form-check">
          {!! Form::checkbox('service_id[]', $deviceService->service_id, null, ['id' => 'service_'.$deviceService->service_id, 'class' => 'form-check-input']) !!}
          {!! Form::label('service_'.$deviceService->service_id, $deviceService->service_type, ['class' => 'form-check-label']) !!}
        </div>
        @endforeach
      </div>
      {{-- Hidden Technician Inputs --}}
      {!! Form::hidden('technician_id', null) !!}
      {!! Form::hidden('technician_name', null) !!}
      {{-- Submit Button --}}
      {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
      {!! Form::close() !!}
    </div>
  </div>
</div>
@endsection
