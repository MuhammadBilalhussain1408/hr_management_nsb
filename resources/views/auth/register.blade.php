@extends('partial.layout')
@section('content')
<!--Start breadcrumb area paroller-->
<section class="breadcrumb-area">
    <div class="breadcrumb-area-bg" style="background-image: url(assets/images/breadcrumb/breadcrumb-1.jpg);">
    </div>
    <div class="shape-box"></div>
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="inner-content">

                    <div class="breadcrumb-menu">
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li class="active">Contact</li>
                        </ul>
                    </div>
                    <div class="title" data-aos="fade-up" data-aos-easing="linear" data-aos-duration="1500">
                        <h2>Contact</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--End breadcrumb area-->

<!--Start Main Contact Form Area-->
<section class="main-contact-form-area">
    <div class="container">
        <div class="sec-title text-center">
            <div class="sub-title">
                <div class="border-box"></div>
                <h3>Your Virtual HR Manager</h3>
            </div>
            <h2 class="card-header">{{ __('Register') }}</h2>
             @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                        @endif
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="contact-form">
                    <form  class="default-form2" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row  mb-3">
                            <label for="company_name" class="col-md-4 col-form-label text-md-end">{{ __(' Company Name') }}</label>

                            <div class="col-xl-6">
                                <div class="form-group">
                                    <div class="input-box">
                                        <input type="text" name="company_name" id="formName" placeholder="Company Name" required="">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-xl-6">
                                <div class="form-group">
                                    <div class="input-box">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    </div>
                                </div>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="lname" class="col-md-4 col-form-label text-md-end">{{ __('Last Name') }}</label>

                            <div class="col-xl-6">
                                <div class="form-group">
                                    <div class="input-box">
                                        <input id="lname" type="text" class="form-control @error('lname') is-invalid @enderror" name="lname" value="{{ old('lname') }}" required autocomplete="lname" autofocus>
                                    </div>
                                </div>
                                @error('lname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row  mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row  mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Phone Numer') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">

                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row  mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="row  mb-3">
                            <div class="col-xl-10">
                                <div class="form-group">
                                    <div class="input-box">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" value="Yes" name="terms_conditions" required=""> I confirm that I have read the <a href="{{asset('privacy-policy')}}">Privacy Policy</a> and I
                                            agree to the website <a href="{{('terms')}}">Terms
                                                of Use</a> and <a href="{licence-agreement}">License Agreement</a>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row  mb-3">
                            <div class="col-xl-10">
                                <div class="form-group">
                                    <div class="input-box">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" value="Yes" name="immigration" required=""> I understand that they do not, in any way,
                                            replace immigration advice
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button class="btn-one btn" type="submit" >
                                        {{ __('Register') }}
                                </button>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
</section>
<!--End Main Contact Form Area-->

@endsection