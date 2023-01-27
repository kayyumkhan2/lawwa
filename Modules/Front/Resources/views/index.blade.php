@extends('front::layouts.master')
@section('title') Home @endsection
@section('content')
<section class="lawwa-banner">
  <div class="swiper-container">
    <div class="swiper-wrapper">
      @if (count($banners) > 0)
      @forelse($banners as $banner)
         <div class="swiper-slide" >
           <img src="{{ asset('public/images/banner_images/'.$banner->banner) }}">
         </div>
      @endforeach
      @else
      <div class="swiper-slide"> </div>
      @endif
    </div>
    <div class="swiper-pagination"></div>
  </div>
</section>

<!-- Lawwa About -->
<section class="lawwa-about">
  <div class="container">
      <div class="about-wrap">
        <div class="about-bg">
          @if ($homepagecontent !='')
            @if ($homepagecontent->about_us_image !='')
              <img src="{{asset('images/frontpages/aboutusimages/'.$homepagecontent->about_us_image)}}" alt="about-bg">
            @endif
            @else
              <img src="{{asset('front/assets/images/backgrounds/about-bg.png')}}" alt="about-bg">
          @endif  
        <div class="about-info">
          <h2 class="section-title">About Us</h2>
          <div class="row" >
            <div class="col-lg-6 col-md-12">
            <div class="about_content main">
            @if ($homepagecontent !='')
            <p> {!!$homepagecontent->about_us_text!!} </p> 
            @else
            <p>Lawwa.Asia is your Personal Beauty Therapist service provider. We are the first to introduce a Pre-Booking Mobile Personal Beauty Therapist application in Malaysia! At the touch of your fingertips, we will deliver beauty services to your home, office or other premises of your choice.</p>
            <p>We understand how busy life gets and we are here to make it as easy, affordable and comfortable as possible for you to enjoy our high-quality beauty treatment by our professionally trained Personal Beauty Therapists (PBT).</p>
            <p>With our dedicated team responsible to ensure your treatments are well delivered, we comply with the government’s New Normal Covid-19 guidelines and safety measures by practising high SOP requirements which include social distancing, face mask, health declarations, as well as frequent deep cleaning of equipment.</p>
            <p>All of our tools are sanitised regularly and no products are shared with other customers. This includes headband towels, creams, lotions and treatment kits. We implement good hygiene practice and help to prevent any virus spreads at the same time.</p>
            <p>Lawwa.Asia provides beauty care in the comfort of your location with our PBT you can trust. Our very own line of products and services can cater to various treatments and special occasions from head to toe. </p>
            <p>The need for convenient beauty treatments is in high demand and we are always recruiting PBT through our briefing and interview sessions. Ongoing comprehensive training course and qualification as our PBT is carried out with registered training centres throughout the year.</p>
            <p>Lawwa.Asia is your one-stop beauty digital hub offering a seamless solution to beauty maintenance and beauty treatments at competitive prices. Join us as a member and enjoy special promotions, updated news and be notified for our coming events. Visit our website today!</p>
            <p>Lawwa.Asia provides beauty care in the comfort of your place with our PBT you can trust.</p>
            @endif
            </div>
            <a href="javascript:void(0);" class="showcontent lawwa-btn">Show more</a>
          </div>
          @if ($homepagecontent !='')
          <div class="col-lg-6 col-md-12">
            <div class="video-block">
              <figure>
                <video width="100%" height="300" class="w3-border w3-padding" controls>
                  <source src="{{asset('images/frontpages/homepagevideos/'.$homepagecontent->about_us_video)}}" type="video/mp4">
                  <source src="{{asset('images/frontpages/homepagevideos/'.$homepagecontent->about_us_video )}}" type="video/ogg">
                 Your browser does not support the video tag.
               </video>
              </figure>
           </div>
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
  </div>
</section>
<!-- Lawwa Member -->
<section class="lawwa-member">
  <div class="container">
    <h2 class="section-title">Membership</h2>
     @if ($homepagecontent !='')
        <p> {!!$homepagecontent->membership_text!!} </p> 
        @else
    <p>Sign up to be a member of Lawwa.Asia and enjoy special promotions, updates and exclusive invitations.  Register as a member to enjoy our beauty treatments and receive a personal beauty starter kit.</p>
        @endif
    <div class="lawwa-btn-wrap">
      <a href="{{route('pages.membership')}}" class="lawwa-btn larg-btn">Membership <img src="{{ asset('front/assets/images/icons/btn-icon.svg' ) }}" alt="Btn Icon" width="30"></a>
    </div>
  </div>
</section>
<!-- Lawwa Contact -->
<section class="lawwa-contact">
  <div class="container">
    <h2 class="section-title">Contact Us</h2>
    @if ($homepagecontent !='')
        <p> {!!$homepagecontent->contact_us_text!!} </p> 
        @else
     <p>Lawwa.Asia has built its reputation and business via our ability to respond the needs of the customer. We look forward to hear from you and hope for a fruitful relationship in the future. Please do not hesitate to contact us if there is a need for further information.</p>
    <p>Lawwa.Asia is wholly owned by Trokatech Resources Sdn. Bhd.</p>
    @endif
    <div class="contact-wrap">
      <div class="row">
        <div class="col-lg-8">
          <div class="contact-info">
            <h2>Contact Us Form</h2>
            <ul class="contact-link">
              <li>
                <div class="lawwa-icon"><img src="{{ asset('front/assets/images/icons/email-icon.svg' ) }}" alt="Email" width="26"></div>
                <div class="contact-link-info">
                @if (count($emails) > 0)
                    @forelse($emails as $email)
                  <a href="mailto:sales@lawwa.asia">{{$email->mail_id}}</a>
                  <br>
                    @endforeach
                    @else
                  <a href="mailto:sales@lawwa.asia">sales@lawwa.asia</a>
                   @endif
                </div>
              </li>
              <li>
                <div class="lawwa-icon"><img src="{{ asset('front/assets/images/icons/phone-icon.svg' ) }}" alt="Email" width="26"></div>
                <div class="contact-link-info">
                @if (count($contactnumbers) > 0)
                    @forelse($contactnumbers as $contactnumber)
                      <a href="tel:{{$contactnumber}}">+{{$contactnumber->number}}</a>
                      <br>
                    @endforeach
                    @else
                      <a href="tel:6067602229">+60 6067602229</a>
                   @endif
                </div>
              </li>
              <li>
                <div class="lawwa-icon"><img src="{{ asset('front/assets/images/icons/address.svg' ) }}" alt="Address" width="22"></div>
                <div class="contact-link-info">
                  @if (count($addressess) > 0)
                    @forelse($addressess as $address)
                    {!!$address->address!!} 
                    @endforeach
                  @else
                    <p>Unit 3-3, MH Avenue, No 2 Jalan BungaKantan, <br> Off Jalan Genting Kelang, Setapak 53300 <br> Kuala Lumpur.</p>
                    <p>LAOSR : Lawwa.Asia Oasis Southern Region No 2 - 1, <br> Tingkat 1, Jalan Oasis 1 Pusat Perniagaan Oasis, <br> 70200 Seremban, N.Sembilan.</p>
                    <p>LATH : Lawwa.Asia Technology Hub Innovation Incubation Centre 2nd Floor, <br> Resource Centre Technology Park Malaysia, <br> 57000 Bukit Jalil Kuala Lumpur, <br> Malaysia</p>
                    <p>Visit our website for more information or to book a session today.</p>
                  @endif
                </div>
              </li>
            </ul>
          </div>
        </div>
        <style type="text/css">
            .error {
            color: #000000 !important;
          }
        </style>
        <div class="col-lg-4">
          <div class="contact-form">
            <form  method="post" action="{{ route('contact.store') }}" id="formid">
               @csrf   
              <div class="form-group">
                <span class="asteriskconact"></span>
                 <input type="text" class="form-control {{ $errors->has('name') ? 'error' : '' }}" value="{{old('name')}}" name="name" id="name" placeholder="Name">
                 <!-- Error -->
                  @if ($errors->has('name'))
                  <div class="error">
                      {{ $errors->first('name') }}
                  </div>
                  @endif
              </div>
              <div class="form-group">
                 <input type="text" class="form-control {{ $errors->has('company') ? 'error' : '' }}" value="{{old('company')}}" name="company" id="company" placeholder="Company">
                 <!-- Error -->
                  @if ($errors->has('company'))
                  <div class="error">
                      {{ $errors->first('company') }}
                  </div>
                  @endif
              </div>
              <div class="form-group">
                <span class="asteriskconact"></span>
                <input type="email" class="form-control {{ $errors->has('email') ? 'error' : '' }}" value="{{old('email')}}" id="email" name="email" placeholder="Email">
                 @if ($errors->has('email'))
                  <div class="error">
                      {{ $errors->first('email') }}
                  </div>
                  @endif
              </div>
              <div class="form-group">
                <span class="asteriskconact"></span>
                <input type="tel" class="form-control {{ $errors->has('phone') ? 'error' : '' }}" maxlength="12" minlength="7"   name="phone" value="{{old('phone')}}"  placeholder="Mobile No">
                @if ($errors->has('phone'))
                  <div class="error">
                      {{ $errors->first('phone') }}
                  </div>
                  @endif
              </div>
              <div class="form-group">
                <span class="asteriskconact"></span>
                <input type="text" class="form-control {{ $errors->has('subject') ? 'error' : '' }}" value="{{old('subject')}}" id="subject" name="subject" placeholder="Subject">
                 @if ($errors->has('subject'))
                  <div class="error">
                      {{ $errors->first('subject') }}
                  </div>
                  @endif
              </div>
              <input type="text" hidden="" name="type" value="Contact-us">
              <div class="form-group">
                <span class="asteriskconact"></span>
                <textarea class="form-control {{ $errors->has('message') ? 'error' : '' }}" id="message" name="message" placeholder="Message">{{old('message')}}</textarea>
                @if ($errors->has('message'))
                <div class="error">
                    {{ $errors->first('message') }}
                </div>
                @endif
              </div>
              <div class="pt-md-3">
                <button type="submit" class="lawwa-btn w-100">Send</button>
              </div>
               @if(Session::has('success'))
              <br>
              <div class="alert alert-success">
                  {{Session::get('success')}}
              </div>
            @endif
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- Lawwa Map -->
<section class="lawwa-map mt-5">
  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d214398.4524980672!2d101.59015268576823!3d3.143463231649758!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cc49c701efeae7%3A0xf4d98e5b2f1c287d!2sKuala%20Lumpur%2C%20Federal%20Territory%20of%20Kuala%20Lumpur%2C%20Malaysia!5e0!3m2!1sen!2sin!4v1612960020213!5m2!1sen!2sin" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
</section>
@jquery
@toastr_js
@toastr_render
@endsection

@section('js')
<script type="text/javascript">
  $(document).ready(function(){
   $(".alert-success").fadeTo(5000, 500).slideUp(500, function(){
    $(".alert-success").slideUp(500);
  });
});
</script>
  <script type="text/javascript">
    jQuery.validator.addMethod("customEmail", function(value, element) {
             return this.optional(element) || /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i.test(value);
            }, "Please enter valid email address!");
    jQuery.validator.addMethod("full_name", function(value, element) {
             return this.optional(element) || /^[a-zA-Z ]+$/.test(value);
            }, "Please enter valid full Name !");
    $(function() {
          $("#formid").validate({
          rules: {
             'name': {
              required: true,
              minlength:2,
              full_name:true,
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
              digits: true
             },
             'message': {
              required: true,
             }     
            },
          });
    });
</script>
<script>
$(document).ready(function(){
  $(".showcontent").click(function(){
    $(".about_content").toggleClass("main");
    var text= $(".showcontent").text();
    if (text=="Show more") {
      $(".showcontent").text("Less");
    }
    else{
      $(".showcontent").text("Show more");
    }
  });
});
</script>
@endsection


