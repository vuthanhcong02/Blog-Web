@extends('Frontend.layouts.base')
@section('title', 'Setting')
@section('body')
    <!-- Banner Ends Here -->
    <div class="container" style="padding-top: 100px">
        <section style="">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-8">
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body p-4">
                                <div class="text-black">
                                    <form method="post" action="/account/change-avatar" enctype="multipart/form-data">
                                        @csrf
                                        <div class="d-flex flex-column justify-content-center align-items-center">
                                            <img src="assets/images/avatar/{{ Auth::user()->avatar ?? 'default-avatar.jpeg' }}"
                                                alt="Generic placeholder image" class="img-fluid"
                                                style="width: 180px; height: 180px; border-radius:50%; object-fit: cover;" name="avatar" id="avatarImage" />
                                        </div>
                                        <div class="d-flex flex-column align-items-center justify-content-center">
                                            <label class="label">
                                                @if(Auth::check())
                                                    <input type="file" required onchange="changeImg(this);this.form.submit()"
                                                        value="{{ old('avatar') }}" name="avatar"
                                                        accept="image/x-png,image/gif,image/jpeg" />
                                                    <span>Thay đổi avatar</span>

                                                @endif
                                            </label>
                                        </div>
                                    </form>
                                    <form method="post" action="/account/update-profile">
                                        @csrf
                                        @method('PUT')
                                        <div class="flex-grow-1 ms-3">
                                            <div class="d-flex flex-column align-items-center mt-2">
                                                <h5 class="mb-1">{{ Auth::user()->name ?? ''}}</h5>
                                                <p class="mb-2 pb-1" style="color: #2b2a2a;">
                                                    {{ Auth::user()->role ?? ''}}
                                                </p>
                                            </div>
                                            <div class="d-flex flex-column align-content-center rounded-3 p-2 mb-2"
                                                style="background-color: #efefef;">
                                                <div class="mb-3">
                                                    <label for="exampleInputPassword1" class="form-label">User Name</label>
                                                    <input type="text" class="form-control" id="" name="name"
                                                        value="{{ Auth::user()->name ?? ''}}">
                                                    @error('name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleInputPassword1" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="" name="email"
                                                        value="{{ Auth::user()->email ?? ''}}">
                                                    @error('email')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleInputPassword1" class="form-label">Mật khẩu <span
                                                            class="required">(Nếu không thay đổi thì để trống !)</span></label>
                                                    <input type="password" class="form-control" id="" name="password"
                                                        value="">

                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <button type="submit" class="btn btn-outline-warning me-1 flex-grow-1 m-1"
                                                    style="color: #2b2a2a;">
                                                    Lưu
                                                </button>
                                                <a href="/" type="button"
                                                    class="btn btn-outline-warning me-1 flex-grow-1 m-1"
                                                    style="color: #2b2a2a;">
                                                    Thoát
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script>
        function changeImg(input) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatarImage').src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    </script>
@endsection
