@extends('Frontend.layouts.base')
@section('title', 'Login')
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
                    <!-- Email input -->
                    <div class="form-outline mb-3">
                      <label class="form-label" for="form2Example1">Email address<sup class="required">*</sup></label>
                      <input type="email" id="form2Example1" class="form-control" name="email" />
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-3">
                        <label class="form-label" for="form2Example2">Password<sup class="required">*</sup></label>
                      <input type="password" id="form2Example2" class="form-control" name="password" />
                    </div>

                    <!-- 2 column grid layout for inline styling -->
                    <div class="row mb-3">
                      <div class="col d-flex justify-content-center">
                        <!-- Checkbox -->
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked name="remember" />
                          <label class="form-check-label" for="form2Example31"> Remember me </label>
                        </div>
                      </div>

                      <div class="col">
                        <!-- Simple link -->
                        <a href="#!" style="color: #f48840">Forgot password?</a>
                      </div>
                    </div>

                    <!-- Submit button -->
                    <button type="button" class="btn btn-block mb-3 font-weight-bold text-white" style="background-color:#f48840;">Login</button>

                    <!-- Register buttons -->
                    <div class="text-center">
                      <p>Not a member? <a href="/account/register" style="color: #f48840">Register</a></p>
                      <p>or sign up with:</p>
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
