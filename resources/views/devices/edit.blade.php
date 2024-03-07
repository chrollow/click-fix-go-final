@extends('layouts.base')

@section('body')
<div class="container">
    <div class="card col-12 col-md-8 col-lg-6 m-auto border-0 shadow-lg">
        <div class="card-header bg-dark-blue text-light">
            {{ __('Update Device') }}
        </div>
        <div class="card-body">
            {!! Form::model($device, ['route' => ['devices.update', $device->device_id], 'class' => 'form-control', 'files' => true, 'method' => 'put']) !!}
            {{-- Device Type --}}
            <div class="mb-3">
                {{ Form::label('device_type', __('Device Type'), ['class' => 'form-label']) }}
                {!! Form::text('device_type', $device->device_type, ['class' => 'form-control']) !!}
            </div>
            {{-- Image Upload --}}
            <div class="mb-3">
                {{ Form::label('image', __('Device Image'), ['class' => 'form-label']) }}
                {!! Form::file('image', ['class' => 'form-control']) !!}
                @error('image')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <img src="{{ url($device->image) }}" alt="{{$device->device_type}} image" width="50" height="50">
            </div>
            {{-- Submit Button --}}
            <div class="mb-3">
                {!! Form::submit(__('Submit'), ['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
