@extends('frontend.layouts.base')
@section('title', 'Register')
@section('body')
    <x-frontend.common.banner />
    <div class="container" style="padding-top: 50px">
        <div class="row">
            <div class="col d-flex justify-content-center align-items-center">
                <form style="width: 500px" action="" method="POST">
                    @csrf
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{session('error')}}
                        </div>
                    @endif
                    <div class="form-outline mb-2">
                        <label class="form-label" for="name">Name<sup class="required">*</sup></label>
                        <input type="text" id="name" class="form-control" required
                            name="name" value="{{old('name')}}" />
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Email input -->
                    <div class="form-outline mb-2">
                        <label class="form-label" for="email">Email address<sup class="required">*</sup></label>

                        <input type="email" id="email" class="form-control" required
                            name="email" value="{{old('email')}}" />
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-2">
                        <label class="form-label" for="password">Password<sup class="required">*</sup></label>

                        <input type="password" id="password" class="form-control" required
                            name="password" value="{{old('password')}}" />
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="h-captcha mb-2 d-flex justify-content-center" name="h-captcha-response" data-sitekey="{{ $hCaptchaSiteKey }}"></div>
                    @error('h-captcha-response')
                            <div class="text-danger d-flex justify-content-center">{{ $message }}</div>
                    @enderror
                    <!-- Submit button -->
                    <button type="submit" class="btn btn-block mb-3 font-weight-bold text-white mt-2"
                        style="background-color:#f48840;">Register</button>

                    <!-- Register buttons -->
                    <div class="text-center">
                        <p>Have an account ? <a href="{{ route('login') }}" style="color: #f48840">Login</a></p>
                    </div>

                     <!-- Register buttons -->
                     <div class="text-center">
                        <p>or login with:</p>
                        <div class="d-flex justify-content-center">
                            <a type="button" class="btn btn-link btn-floating mx-1">
                                <i class="bi bi-google"></i>
                            </a>
                            <a type="button" class="btn btn-link btn-floating mx-1">
                                <i class="bi bi-facebook"></i>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('javascript')
<script src="https://js.hcaptcha.com/1/api.js" async defer></script>
@endpush