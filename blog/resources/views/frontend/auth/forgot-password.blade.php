@extends('frontend.layouts.base')
@section('title', 'Forgot Password')
@section('body')
    <x-frontend.common.banner/>
    <div class="container" style="padding-top: 50px">
        <div class="row">
            <div class="col d-flex justify-content-center align-items-center">
                <form style="width: 500px" action="{{ route('password.email') }}" method="post">
                    @csrf
                    <!-- Email input -->
                    <div class="form-outline mb-3">
                        <label class="form-label" for="form2Example1">Email address<sup class="required">*</sup></label>
                        <input type="email" id="form2Example1" class="form-control" name="email" value="" />
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Submit button -->
                    <button type="submit" class="btn btn-block mb-3 font-weight-bold text-white"
                        style="background-color:#f48840;">Reset password</button>
                </form>
            </div>
        </div>
    </div>
@endsection
