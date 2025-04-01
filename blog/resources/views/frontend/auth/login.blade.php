@extends('frontend.layouts.base')
@section('title', 'Login')
@section('body')
    <x-frontend.common.banner/>
    <div class="container" style="padding-top: 50px">
        <div class="row">
            <div class="col d-flex justify-content-center align-items-center">
                <form style="width: 500px" action="" method="post">
                    @csrf
                    <!-- Email input -->
                    <div class="form-outline mb-3">
                        <label class="form-label" for="form2Example1">Email address<sup class="required">*</sup></label>
                        <input type="email" id="form2Example1" class="form-control" name="email" value="{{ old('email') }}" required/>
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-3">
                        <label class="form-label" for="form2Example2">Password<sup class="required">*</sup></label>
                        <input type="password" id="form2Example2" class="form-control" name="password" required/>
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- 2 column grid layout for inline styling -->
                    <div class="row mb-3">
                        <div class="col d-flex justify-content-center">
                            <!-- Checkbox -->
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="checked" id="form2Example31"
                                    name="remember" />
                                <label class="form-check-label" for="form2Example31"> Remember me </label>
                            </div>
                        </div>

                        <div class="col">
                            <!-- Simple link -->
                            <a href="{{ route('password.request') }}" style="color: #f48840">Forgot password?</a>
                        </div>
                    </div>

                    <!-- Submit button -->
                    <button type="submit" class="btn btn-block mb-3 font-weight-bold text-white"
                        style="background-color:#f48840;">Login</button>

                    <!-- Register buttons -->
                    <div class="text-center">
                        <p>Not a member? <a href="{{ route('register') }}" style="color: #f48840">Register</a></p>
                        <p>or sign up with:</p>
                        <div class="d-flex justify-content-center">
                            <a type="button" class="btn btn-link btn-floating">
                                <i class="bi bi-google"></i>
                            </a>
                            <a type="button" class="btn btn-link btn-floating">
                                <i class="bi bi-github"></i>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
