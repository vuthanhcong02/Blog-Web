@extends('frontend.layouts.base')
@section('title', 'Reset Password')
@section('body')
    <x-frontend.common.banner/>
    <div class="container" style="padding-top: 50px">
        <div class="row">
            <div class="col d-flex justify-content-center align-items-center">
                <form style="width: 500px" action="{{ route('password.update') }}" method="post">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <!-- Email input -->
                    <div class="form-outline mb-3">
                        <label class="form-label" for="form2Example1">Email address<sup class="required">*</sup></label>
                        <input type="email" id="form2Example1" class="form-control" name="email" value="{{ request()->email }}" readonly/>
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-3">
                        <label class="form-label" for="form2Example2">Password<sup class="required">*</sup></label>
                        <input type="password" id="form2Example2" class="form-control" name="password" />
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                     <!-- Confirm Password input -->
                     <div class="form-outline mb-3">
                        <label class="form-label" for="form2Example2">Confirm Password<sup class="required">*</sup></label>
                        <input type="password" id="form2Example2" class="form-control" name="password_confirmation" />
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Submit button -->
                    <button type="submit" class="btn btn-block mb-3 font-weight-bold text-white"
                        style="background-color:#f48840;">Reset Password</button>
                </form>
            </div>
        </div>
    </div>
@endsection
