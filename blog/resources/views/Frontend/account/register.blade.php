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
                <form style="width: 500px">
                    <div class="form-outline mb-2">
                        <label class="form-label" for="form2Example1">Name<sup class="required">*</sup></label>

                        <input type="text" id="form2Example1" class="form-control" placeholder="Nhập usename ..."
                            name="username" />
                    </div>
                    <!-- Email input -->
                    <div class="form-outline mb-2">
                        <label class="form-label" for="form2Example1">Email address<sup class="required">*</sup></label>

                        <input type="email" id="form2Example1" class="form-control" placeholder="Nhập email ..."
                            name="email" />
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-2">
                        <label class="form-label" for="form2Example2">Password<sup class="required">*</sup></label>

                        <input type="password" id="form2Example2" class="form-control" placeholder="Nhập password ..."
                            name="password" />
                    </div>
                    <div class="form-outline mb-2">
                        <label class="form-label" for="form2Example2">ComfirmPassword<sup class="required">*</sup></label>

                        <input type="password" id="form2Example2" class="form-control" placeholder="Nhập lại password ..."
                            name="repassword" />
                    </div>
                    <!-- 2 column grid layout for inline styling -->
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked
                            name="remember" />
                        <label class="form-check-label" for="form2Example31"> Remember me </label>
                    </div>

                    <!-- Submit button -->
                    <button type="button" class="btn btn-block mb-3 font-weight-bold text-white"
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
