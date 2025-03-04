@extends('Frontend.layouts.base')
@section('title', 'Register')
@section('body')
    <!-- Banner Starts Here -->
    <div class="heading-page header-text mt-2">
        <section class="page-heading" style="padding: 80px 0 !important">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-content">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Banner Ends Here -->
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
                        <label class="form-label" for="form2Example1">Name<sup class="required">*</sup></label>
                        <input type="text" id="form2Example1" class="form-control" placeholder="Nhập usename ..."
                            name="name" value="{{old('name')}}" />
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Email input -->
                    <div class="form-outline mb-2">
                        <label class="form-label" for="form2Example1">Email address<sup class="required">*</sup></label>

                        <input type="email" id="form2Example1" class="form-control" placeholder="Nhập email ..."
                            name="email" value="{{old('email')}}" />
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-2">
                        <label class="form-label" for="form2Example1">Password<sup class="required">*</sup></label>

                        <input type="password" id="form2Example1" class="form-control" placeholder="Nhập password ..."
                            name="password" value="{{old('password')}}" />
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-outline mb-2">
                        <label class="form-label" for="form2Example2">Comfirm Password<sup class="required">*</sup></label>

                        <input type="password" id="form2Example2" class="form-control" placeholder="Nhập lại password ..."
                            name="repassword" value="{{old('repassword')}}" />
                        @error('repassword')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Submit button -->
                    <button type="submit" class="btn btn-block mb-3 font-weight-bold text-white mt-2"
                        style="background-color:#f48840;">Register</button>

                    <!-- Register buttons -->
                    <div class="text-center">
                        <p>Have an account ? <a href="/account/login" style="color: #f48840">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
