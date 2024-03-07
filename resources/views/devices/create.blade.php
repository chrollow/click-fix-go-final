@extends('layouts.base')

@section('body')
<div class="container">
    <div class="card col-12 col-md-8 col-lg-6 m-auto border-0 shadow-lg">
        <div class="card-header bg-dark-blue text-light">
            {{ __('Add New Device') }}
        </div>
        <div class="card-body">
            {!! Form::open(['route' => 'devices.store', 'class' => 'form-control', 'enctype' => 'multipart/form-data', 'method' => 'post']) !!}
            {{-- Device Type --}}
            <div class="mb-3">
                {{ Form::label('device_type', __('Device Type'), ['class' => 'form-label']) }}
                {!! Form::text('device_type', null, ['class' => 'form-control', 'placeholder' => __('Enter device type')]) !!}
            </div>
            {{-- Image Upload --}}
            <div class="mb-3">
                {{ Form::label('image', __('Device Image'), ['class' => 'form-label']) }}
                {!! Form::file('image', ['class' => 'form-control']) !!}
                @error('image')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
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
