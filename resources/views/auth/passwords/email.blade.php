@extends('layouts.app')

@section('content')
<div class="form-container outer">
    <div class="form-form">
        <div class="form-form-wrap">
            <div class="form-container">
                <div class="form-content">
                    <span>
                        <img src="{{asset('assets/img/90x90.jpg')}}" alt="CoVerify" height="60">
                    </span>
                    <p class="mt-3 mb-1">Enter your email address to reset your password.</p>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}" class="text-left">
                        @csrf
                        <div class="form">
                            <div id="username-field" class="field-wrapper input">
                                <div class="d-flex justify-content-between">
                                    <label for="username">Email</label>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2">
                                    </path><circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email"  required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="d-sm-flex justify-content-between mb-3">
                                <div class="field-wrapper">
                                    <button type="submit" class="btn btn-primary submit-btn mt-3" value="">{{ __('Send Password Reset Link') }}</button>
                                </div>
                            </div>
                            <a href="{{ url('login') }}" style="text-decoration:none;">Back to login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
