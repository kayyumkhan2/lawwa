<footer class="lawwa-footer mt-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-4">
        <div class="footer-logo">
          <img src="{{ asset('front/assets/images/lawwa-brand.svg')}}" alt="Lawwa" width="225">
        </div>
        <div class="visible-print text-center">
          <!-- <h1>Laravel 5.7 - QR Code Generator Example</h1> -->
            {!! QrCode::size(100)->generate('https://lawwa.ezxdemo.com'); !!}
            <p>QR Code Lawwa.Asia Apps in Playstore (Android)</p>
        </div>
         @if (count(footer("socialLinks")) > 0)
        <div class="lawwa-social">
          @forelse(footer("socialLinks") as $social)
            <a href="{{$social->url}}" target="_blank">  <img src="{{ asset('public/images/sociallinks/'.$social->icon )}}" height="50" width="50" alt="img"></a>
          @endforeach
          </div>
      @else
      <div class="lawwa-social">
          <a href="#0"><i class="fa fa-facebook" aria-hidden="true"></i></a>
          <a href="#0"><i class="fa fa-twitter" aria-hidden="true"></i></a>
          <a href="#0"><i class="fa fa-instagram" aria-hidden="true"></i></a>
          <a href="#0"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
        </div>
      @endif
        
        <a href="{{route('front.home')}}" class="lawwa-web"><img src="{{ asset('front/assets/images/icons/world-web.svg')}}" alt="World Web" width="28">www.lawwa.asia</a>
      </div>
      <div class="col-lg-3 col-md-5">
        <div class="footer-link inner-link">
          <h3>QUICK LINKS</h3>
          <ul class="footer-link-wrap">
            <li><a href="{{route('front.home')}}">Home</a></li>
            <li><a href="{{route('pages.about-us')}}" target="_blank">About Us</a></li>
            <li><a href="{{route('services.servicescategory')}}" target="_blank">Our Services</a></li>
            <li><a href="{{route('products.productscategory')}}" target="_blank">Our Beauty Products</a></li>
            <li><a href="{{route('pages.contact-us')}}" target="_blank">Contact Us</a></li>
            <li><a href="{{route('pages.support')}}" target="_blank">Support</a></li>
          </ul>
        </div>
      </div>
      <div class="col-lg-5 col-md-7">
        <div class="footer-link">
          <h3>CONTACT US</h3>
          <ul class="contact-link">
            <li>
              <div class="lawwa-icon"><img src="{{asset('front/assets/images/icons/address.svg')}}" alt="Address" width="22"></div>
              <div class="contact-link-info">
                @if (count(footer("addressess")) > 0)
                    @forelse(footer("addressess") as $address)
                    {!!$address->address!!} 
                    @endforeach
                    @else
                    <p class="address-info"><span>Trokatech resources Sdn Bhd.</span> <br> Unit 3-3, MH Avenue, No 2, Jalan Bunga Kantan Off <br> Jalan Genting Kelange, Setapak 53300 Kuala <br> Lumpur</p>
                    <p><span>Seremban :</span> No 2-1, Tingkat 1, Jalan Oasis 1, Pusat <br> Periagaan Oasis, 70200 Seremban, <br> N.Sembilan</p>
                @endif
                
              </div>
            </li>
            <li>
              <div class="lawwa-icon"><img src="{{asset('front/assets/images/icons/email-icon.svg')}}" alt="Email" width="26"></div>
              <div class="contact-link-info">
                @if (count(footer("emails")) > 0)
                    @forelse(footer("emails") as $email)
                  <a href="mailto:{{$email->mail_id}}">{{$email->mail_id}}</a>
                  <br>
                    @endforeach
                    @else
                  <a href="mailto:sales@lawwa.asia">sales@lawwa.asia</a>
                   @endif
              </div>
            </li>
            <li>
              <div class="lawwa-icon"><img src="{{asset('front/assets/images/icons/phone-icon.svg')}}" alt="contactnumber" width="26"></div>
              <div class="contact-link-info">
                @if (count(footer("contactnumbers")) > 0)
                    @forelse(footer("contactnumbers") as $contactnumber)
                      <a href="tel:{{$contactnumber->number}}">+{{$contactnumber->number}}</a>
                    <br>
                    @endforeach
                    @else
                      <a href="tel:+60 6067602229">+60 6067602229</a>
                @endif
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="lawwa-copyright">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-6">
          <p>Copyright &copy; <script type="text/javascript">document.write(new Date().getFullYear())</script> <a href="{{route('front.home')}}">Lawwa.Asia</a> All Rights Reserved.</p>
        </div>
        <div class="col-md-6 text-md-right">
          <ul>
            <li><a href="{{route('pages.terms-condition')}}">Terms & Conditions</a></li>
            <li><a href="{{route('pages.privacy-policy')}}">Privacy Policy</a></li>
            <li><a href="{{route('pages.faq')}}">FAQ</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</footer>
@if (count(footer("socialLinks")) > 0)
 <div class="lawwa-social-wrap">
    @forelse(footer("socialLinks") as $social)
      <a href="{{$social->url}}" target="_blank">  <img src="{{ asset('public/images/sociallinks/'.$social->icon )}}" height="50" width="50"></a>
    @endforeach
    </div>
@else
<div class="lawwa-social-wrap">
  <a href="#0"><i class="fa fa-facebook" aria-hidden="true"></i></a>
  <a href="#0"><i class="fa fa-twitter" aria-hidden="true"></i></a>
  <a href="#0"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
  <a href="#0"><i class="fa fa-instagram" aria-hidden="true"></i></a>
  <a href="#0"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
</div>
@endif
        