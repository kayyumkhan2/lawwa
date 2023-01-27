@extends('front::layouts.master')
@section('title') Verify Email @endsection
@section('content')
 <div class="container">
    <div class="col-md-12">
      <div class="thans-popup">
        <div class="img-block">
          <img src="{{asset('images/email-icon.svg')}}" alt="Email" width="26">
        </div>
        <div class="card-info">
            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </div>

    @if (session('status') == 'verification-link-sent')
        <div class="verification">
            <div class="card-verification">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        </div>
    @endif
    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <div>
                <input type="submit" class="lawwa-btn" name="" value="Resend Verification Email">
                <!-- <button class="btn btn-primary">
                    Resend Verification Email
                <button> -->
            </div>
        </form>
    </div>
    </div>
  </div>
</div>
@endsection