@extends('Frontend.layouts.base')
@section('title', 'Contact')
@section('body')
    <section class="contact-us" style="margin-top: 120px;">
        <div class="container">
            <div class="row">

                <div class="col-lg-12">
                    <div class="down-contact">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="sidebar-item contact-form">
                                    <div class="sidebar-heading">
                                        <h2>Send us a message</h2>
                                    </div>
                                    <div class="content">
                                        <form id="contact" action="{{ route('contact.send') }}" method="post">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <fieldset class="mb-2"

                                                    >
                                                        <input name="name" type="text" id="name"
                                                            placeholder="Your name" value="{{ old('name') }}">
                                                        @error('name')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </fieldset>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <fieldset  class="mb-2">
                                                        <input name="email" type="text" id="email"
                                                            placeholder="Your email" value="{{ old('email') }}">
                                                        @error('email')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </fieldset>

                                                </div>
                                                <div class="col-md-12 col-sm-12">
                                                    <fieldset class="mb-2">
                                                        <input name="subject" type="text" id="subject"
                                                            placeholder="Subject" value="{{ old('subject') }}">
                                                        @error('subject')
                                                            <span class="text-danger ">{{ $message }}</span>
                                                        @enderror
                                                    </fieldset>

                                                </div>
                                                <div class="col-lg-12">
                                                    <fieldset class="mb-2">
                                                        <textarea name="message" rows="6" id="message" placeholder="Your Message" value="{{ old('message') }}"></textarea>
                                                        @error('message')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </fieldset>

                                                </div>
                                                <div class="col-lg-12">
                                                    <fieldset class="mb-2">
                                                        <button type="submit" id="form-submit" class="main-button">Send
                                                            Message</button>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="sidebar-item contact-information">
                                    <div class="sidebar-heading">
                                        <h2>contact information</h2>
                                    </div>
                                    <div class="content">
                                        <ul>
                                            <li>
                                                <h5>097 1765 824</h5>
                                                <span>PHONE NUMBER</span>
                                            </li>
                                            <li>
                                                <h5>congvtc02@gmail.com</h5>
                                                <span>EMAIL ADDRESS</span>
                                            </li>
                                            <li>
                                                <h5>Thanh Xuân,
                                                    <br>Hà Nội
                                                </h5>
                                                <span>STREET ADDRESS</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div id="map">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.850669022432!2d105.81057987499979!3d20.998622288813543!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ac9096f4d45b%3A0x6996f140129a7453!2zMTkwIMSQLiBOZ3V54buFbiBUcsOjaSwgVGhhbmggWHXDom4gVHJ1bmcsIFRoYW5oIFh1w6JuLCBIw6AgTuG7mWkgMTAwMDAwLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1693100731156!5m2!1svi!2s"
                            width="100%" height="450" style="border:0;" allowfullscreen loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
