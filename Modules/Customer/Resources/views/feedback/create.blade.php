@extends('front::layouts.master')
@section('title') {{$pagename}} @endsection
@section('content')
<!-- Lawwa My Account -->
{!! NoCaptcha::renderJs() !!}
<section class="my-account">
  <div class="container">
    <div class="row">
      @include('customer::includes.sidebar')
      <div class="col-lg-9">
        <div class="right-content content">
          <div class="feedback-header">
            <h6>Feedback</h6>
          </div>
           <div class="my-account-header">            
            <form  action="{{route('customer.feedback.store')}}" method="post" id="formid" enctype="multipart/form-data">
            @csrf
              <div class="feedback-detail show-block" style="">
                <div class="form-group">
                 <input type="text" readonly="" class="form-control {{ $errors->has('name') ? 'error' : '' }}" value="{{old('name',@Auth::user()->full_name)}}" name="name" id="name" placeholder="Name">
                 <!-- Error -->
                  @if ($errors->has('name'))
                  <div class="error">
                      {{ $errors->first('name') }}
                  </div>
                  @endif
              </div>
                <div class="form-group">
                  <input type="email" readonly="" class="form-control {{ $errors->has('email') ? 'error' : '' }}" value="{{old('name',@Auth::user()->email)}}" id="email" name="email" placeholder="Email">
                  @if ($errors->has('email'))
                    <div class="error">
                        {{ $errors->first('email') }}
                    </div>
                  @endif
              </div>
                <div class="form-group">
                  <input type="tel" readonly="" class="form-control {{ $errors->has('phone') ? 'error' : '' }}"  name="phone" value="{{old('name',@Auth::user()->phone_no)}}"  placeholder="Mobile No">
                  @if ($errors->has('phone'))
                    <div class="error">
                        {{ $errors->first('phone') }}
                    </div>
                    @endif
              </div>
                <div class="form-group">
                <textarea class="form-control {{ $errors->has('message') ? 'error' : '' }}" id="message" name="message" placeholder="Message">{{old('message')}}</textarea>
                @if ($errors->has('message'))
                <div class="error">
                    {{ $errors->first('message') }}
                </div>
                @endif
              </div>
            <div class="row align-items-center">
              <div class="col-md-6">
                <div class="captha">
                  {!! NoCaptcha::display() !!}
                  @if ($errors->has('g-recaptcha-response'))
                    <span class="help-block">
                        <strong class="error">{{ $errors->first('g-recaptcha-response') }}</strong>
                    </span>
                  @endif

                </div>
              </div>
              <div class="col-md-6">
                <div class="btn-block">
                  <button type="submit" class="lawwa-btn">Send</button>
                </div>
              </div>
            </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
@section('js')
 <script type="text/javascript">
$(function() {
  ignore: [],
      $("#formid").validate({
      rules: {
         'name': {
          required: true,
         },
         'email': {
          required: true,
          email: true,
         },
         'phone': {
          required: true,
          digits: true
         },
         'message': {
          required: true,
         }     
        },
      });
});
</script>
@endsection