@extends('front::layouts.master')
@section('title') Support @endsection
@section('content')
<!-- Lawwa Page Title -->
{!! NoCaptcha::renderJs() !!}
<section class="lawwa-page-title style-two" style="background-image: url({{asset('front/assets/images/backgrounds/bg-background.png')}})">
  <div class="container">                                               
    <h2>Support</h2>
    <!-- <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Support</li>
      </ol>
    </nav> -->
  </div>
</section>
<section class="breadcrumb-block">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="https://lawwa.ezxdemo.com">Home</a></li>
          <li class="breadcrumb-item"><i class="fa fa-angle-double-right" aria-hidden="true"></i></li>
          <li class="breadcrumb-item active" aria-current="page">Support</li>
        </ol>
      </nav>
    </div>
  </section>
<!-- Support -->
<section class="support">
  <div class="container">
    <div class="support-info">
      <div class="row">
        <div class="col-md-8">
          <div class="img-block">
            <img src="{{asset('front/assets/images/support.png')}}" alt="support">
          </div>
          <form  action="{{route('support.store')}}" method="post" id="formid" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                 <input type="text" class="form-control {{ $errors->has('name') ? 'error' : '' }}" value="{{old('name')}}" name="name" id="name" placeholder="Name">
                 <!-- Error -->
                  @if ($errors->has('name'))
                  <div class="error">
                      {{ $errors->first('name') }}
                  </div>
                  @endif
              </div>
             <div class="form-group">
                <input type="email" class="form-control {{ $errors->has('email') ? 'error' : '' }}" value="{{old('email')}}" id="email" name="email" placeholder="Email">
                 @if ($errors->has('email'))
                  <div class="error">
                      {{ $errors->first('email') }}
                  </div>
                  @endif
              </div>
            <div class="form-group">
                <input type="tel" class="form-control {{ $errors->has('phone') ? 'error' : '' }}"  maxlength="10" minlength="10"  name="phone" value="{{old('phone')}}"  placeholder="Mobile No">
                @if ($errors->has('phone'))
                  <div class="error">
                      {{ $errors->first('phone') }}
                  </div>
                  @endif
              </div>
            <!-- <div class="form-group">
              <select class="form-control" id="type" name='type'>
                <option value="">Support type</option>
                <option value="Support">Support</option>
              </select>
            </div> -->
            <input type="text" hidden="" name="type" value="Support">
            <div class="form-group">
                <input type="text" class="form-control {{ $errors->has('subject') ? 'error' : '' }}" value="{{old('subject')}}" id="subject" name="subject" placeholder="Subject">
                 @if ($errors->has('subject'))
                  <div class="error">
                      {{ $errors->first('subject') }}
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
            <div class="attach-file">
              <!-- <label for="attach-file"><i class="fa fa-paperclip" aria-hidden="true"></i> Attached file</label> -->
              <input type="file" id="attach-file" name="attachfile">
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
                  <button type="submit" class="lawwa-btn">Submit</button>
                </div>
              </div>
            </div>
          </form>
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
          minlength:2,
          full_name:true
         },
         'subject': {
          required: true,
         },
         'email': {
          required: true,
          email: true,
          customEmail: true,
         },
         'phone': {
          required: true,
          digits: true,
         },
         'message': {
          required: true,
         }     
        },
      });
});
</script>
@endsection
