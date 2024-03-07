@extends('layouts.app')

@section('content')
  <div class="container mb-3">
    <div class="card col-12 col-xl-10 m-auto border-0 shadow-lg">
      <div class="card-header bg-dark-blue text-light">
        {{ __('Profile Information') }}
      </div>
      <div class="card-body">
        {{-- Personal Info Form --}}
        <form method="POST" action="#">
          @csrf
          {{-- Customer ID --}}
          <div class="row mb-3">
            <div class="col-12 col-md-6">
              <label class="form-label" for="customer_id">{{ __('Customer ID') }}</label>
              <input class="form-control @error('customer_id') is-invalid @enderror"
                     id="customer_id" name="customer_id" type="text"
                     value="{{ $user->customer_id ?? old('customer_id') }}" autofocus>
              @error('customer_id')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
          {{-- Name and Email --}}
          <div class="row mb-3">
            <div class="col-12 col-md-6">
              <label class="form-label" for="customer_name">{{ __('Customer Name') }}</label>
              <input class="form-control @error('customer_name') is-invalid @enderror" id="customer_name"
                     name="customer_name" type="text" value="{{ $user->customer_name ?? old('customer_name') }}">
              @error('customer_name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="email">{{ __('Email') }}</label>
              <input class="form-control @error('email') is-invalid @enderror" id="email"
                     name="email" type="email" value="{{ $user->email ?? old('email') }}">
              @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
          {{-- Phone Number --}}
          <div class="row mb-3">
            <div class="col-12 col-md-6">
              <label class="form-label" for="phone_number">{{ __('Phone Number') }}</label>
              <input class="form-control @error('phone_number') is-invalid @enderror" id="phone_number"
                     name="phone_number" type="text" value="{{ $user->phone_number ?? old('phone_number') }}">
              @error('phone_number')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
          {{-- Buttons --}}
          <button class="btn btn-primary" type="submit">{{ __('Update') }}</button>
          <a class="btn btn-secondary" type="submit"
             href="{{ url()->previous() }}">{{ __('Back') }}
          </a>
        </form>
      </div>
    </div>
  </div>
@endsection