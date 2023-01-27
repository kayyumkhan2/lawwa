@extends('front::layouts.master')
@section('title') About us @endsection
@section('content')                                           
<section class="lawwa-page-title" style="background-image: url({{asset('front/assets/images/backgrounds/page-title-bg.png')}})">
  <div class="container">
    <h2>About Us</h2>
    <h6>Lawwa.Asia, Your Personal Beauty Therapist</h6>
    <h4>Get to Know us, Lawwa is Love</h4>
  </div>
</section>
  @if ($page =='')
<!-- Lawwa Team -->
<section class="lawwa-team">
  <div class="container-fluid">    
    <div class="team-info">
      <div class="img-block">
        <img src="{{asset('front/assets/images/about-img.png')}}" alt="Team">
      </div>
      <div class="about-content">
        <h2 class="section-title">Team</h2>
        <p>CEO Dr.NazlisyahPh.D (h.c) or well known as Che Nazz in the beauty industry is responsible for making major corporate decisions, managing the overall operations and resources, at the same being the public face of Lawwa.Asia. With years of experience in the telco industry and corporate finance sector, she has served as many senior designations, holding several key positions to the national business fraternity and is truly passionate in helping women entrepreneur to fully explore their potential.</p>
        <p>Technology Team Being the heart of Lawwa.Asia, the technology team is the heart-beat of the whole system. Headed by Tuan HjZamZam, the team ensures all applications and equipment are running smoothly and efficiently.</p>
        <p>Development Partner FIRST VIBRANT INTEGRATED SERVICES (FVIS) led by Dr. Akbar Bin Amawhe is officially Lawwa.Asia’s Development Partner guiding us on specialised area of their expertise and to develop strategies for international exposures.</p>
        <p>Management Team We are proud to have a team who are committed to high standards of integrity and accountability responsible for putting together the business strategy and ensuring our business objectives are met.</p>
        <p>Operation Team The operation team focus on operationalising strategy and tasked with implementing daily operations, aligned with the company’s strategies.</p>
        <p>Marketing Team Our marketing team promotes our business and drives sales of Lawwa.Asia’s products and services at the same time provides necessary research to identify our target customers and other potential markets.</p>
        <p>Recruitment Team Our greatest strength is our PBT; their skills and dedication are what makes Lawwa.Asia the success it is today. Our recruitment team consists of experienced professionals who have on average over 10 years of recruitment and staffing experience to identify, select and recruit suitable PBT to be part of Lawwa.Asia’s big family.</p>
        <p>Academy Team Our training development team handle the learning and professional development of Lawwa.Asia's workforce. It is our duty to equip our organisation with the knowledge, practical skills and motivation to carry out our work activities effectively..</p>
        <p>Product Development We are always in the process of bringing new products to our clients. Our top priority is to make sure all products are safe to use and at the highest quality. Find out more about our products here.</p>
        <p>Research Development Our research development team develop research programs incorporating current developments to improve existing products and study potential of new products.</p>
      </div>
    </div>
  </div>
</section>

<!-- Lawwa Approach -->
<section class="lawwa-approach">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6">
        <div class="img-wrap">
          <div class="row">
            <div class="col-6">
              <div class="img-block">
                <div class="lawwa-table-wrap">
                  <div class="lawwa-align-wrap">
                    <img src="{{asset('front/assets/images/img2.png')}}" class="w-100" alt="img">
                  </div>
                </div>
              </div>
              <div class="img-block">
                <div class="lawwa-table-wrap">
                  <div class="lawwa-align-wrap">
                    <img src="{{asset('front/assets/images/img3.png')}}" class="w-100" alt="img">
                  </div>
                </div>
              </div>
            </div>
            <div class="col-6 mt-4">
              <div class="img-block">
                <div class="lawwa-table-wrap">
                  <div class="lawwa-align-wrap">
                    <img src="{{asset('front/assets/images/img4.png')}}" class="w-100" alt="img">
                  </div>
                </div>
              </div>
              <div class="img-block">
                <div class="lawwa-table-wrap">
                  <div class="lawwa-align-wrap">
                    <img src="{{asset('front/assets/images/img5.png')}}" class="w-100" alt="img">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <h2 class="section-title">Approach</h2>
        <p>Lorem ipsum dolor sittem ametamngcing eiusmoad at the sittem sittem eiusmod There are many variations of passages of Lorem Ipsum available, is simply dummy text of the printing and typesetting industry. Lorem Ipsum industry's standard dummy text ever since the 1500s, when unknown printer took a galley of type and scrambled to make a type specimen book.</p>
        <p>typesetting industry. Lorem Ipsum has industry's standard dummy text ever since unknown printer took a galley of type and scrambled it to make a type specimen only five centuries.</p>
      </div>
    </div>
  </div>
</section>

<!-- Our Mission -->
<section class="mission-vision">
  <div class="container">
    <div class="row">
      <div class="col-lg-5 order-lg-2 text-lg-right">
        <div class="img-block">
          <div class="lawwa-table-wrap">
            <div class="lawwa-align-wrap">
              <img src="{{asset('front/assets/images/img6.png')}}" alt="Img">
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-7 order-lg-1">
        <h2 class="section-title">Our Mission</h2>
        <p>Lorem ipsum dolor sittem ametamngcing eiusmoad at the sittem sittem eiusmod There are many variations of passages of Lorem Ipsum available, is simply dummy text of the printing and typesetting industry. Lorem Ipsum industry's standard dummy text ever since the 1500s, when unknown printer took a galley of type and scrambled to make a type specimen book.</p>
        <p>typesetting industry. Lorem Ipsum has industry's standard dummy text ever since unknown printer took a galley of type and scrambled it to make a type specimen only five centuries.</p>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-5">
        <div class="img-block">
          <div class="lawwa-table-wrap">
            <div class="lawwa-align-wrap">
              <img src="{{asset('front/assets/images/img7.png')}}" alt="Img">
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-7">
        <h2 class="section-title">Our Vision</h2>
        <p>Lorem ipsum dolor sittem ametamngcing eiusmoad at the sittem sittem eiusmod There are many variations of passages of Lorem Ipsum available, is simply dummy text of the printing and typesetting industry. Lorem Ipsum industry's standard dummy text ever since the 1500s, when unknown printer took a galley of type and scrambled to make a type specimen book.</p>
        <p>typesetting industry. Lorem Ipsum has industry's standard dummy text ever since unknown printer took a galley of type and scrambled it to make a type specimen only five centuries.</p>
      </div>
    </div>
  </div>
</section>

<!-- Lawwa About -->
<section class="lawwa-about-wrap">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-5 order-lg-2">
        <div class="img-block">
          <div class="lawwa-table-wrap">
            <div class="lawwa-align-wrap">
              <img src="{{asset('front/assets/images/lawwa-about.svg')}}" alt="Lawwa About">
            </div>            
          </div>
        </div>
      </div>
      <div class="col-lg-7 order-lg-1">
        <h2 class="section-title">#Lawwa You</h2>
        <p>Bring out the natural beauty in you. Lawwa.Asia is passionate to help woman feel good and confident with their natural beauty and abilities. Everyone has their own unique features, sizes and personalities; it is our dedication to help ladies set and achieve their beauty goals in the safest and suitable approach. </p>
        <p>This campaign is to create awareness on how to choose the right products for various beauty care treatments amongst woman of all ages, physical appearance and professional backgrounds to achieve the best result for their beauty aspiration.</p>
        <p>The main objective of this campaign is to educate users the importance of choosing a safe beauty product that suits their beauty treatment requirements to avoid short term and long-term hazardous effects on their skin, body and health.</p>
        <p>The approach of this campaign is constant sharing sessions with the public through talks, seminars, webinars, live online and video postings. We will fully utilise most digital platforms such as our website, social media and telecommunication applications.</p>
        <p>To communicate with the bigger audience, we will work a strategic partnership with the mass media to access nation wide publicity reach through news and magazine articles, radio interviews and featured on TV shows.</p>
        <p>This campaign will be an on-going project with the main intention of educating the public on how to accomplish their beauty goals by using safe products, the right treatment and the most suitable approach. Achieving your beauty goal.</p>
      </div>      
    </div>
  </div>
</section>
@else
<section class="lawwa-team">
  <div class="container-fluid">    
    <div class="team-info">
      <div class="img-block">
        @if (!$page->section_1_image =='')
        <img src="{{asset('images/frontpages/aboutusimages/'.$page->section_1_image)}}" alt="Team">
        @else  
        <img src="{{asset('front/assets/images/about-img.png')}}" alt="Team">
        @endif
      </div>
      <div class="about-content">
        <h2 class="section-title">@if (!$page->section_1_heading =='') {!!$page->section_1_heading!!} @else Team @endif</h2>
        @if (!$page->section_1_content =='') {!!$page->section_1_content!!} @else 
        <p>CEO Dr.NazlisyahPh.D (h.c) or well known as Che Nazz in the beauty industry is responsible for making major corporate decisions, managing the overall operations and resources, at the same being the public face of Lawwa.Asia. With years of experience in the telco industry and corporate finance sector, she has served as many senior designations, holding several key positions to the national business fraternity and is truly passionate in helping women entrepreneur to fully explore their potential.</p>
        <p>Technology Team Being the heart of Lawwa.Asia, the technology team is the heart-beat of the whole system. Headed by Tuan HjZamZam, the team ensures all applications and equipment are running smoothly and efficiently.</p>
        <p>Development Partner FIRST VIBRANT INTEGRATED SERVICES (FVIS) led by Dr. Akbar Bin Amawhe is officially Lawwa.Asia’s Development Partner guiding us on specialised area of their expertise and to develop strategies for international exposures.</p>
        <p>Management Team We are proud to have a team who are committed to high standards of integrity and accountability responsible for putting together the business strategy and ensuring our business objectives are met.</p>
        <p>Operation Team The operation team focus on operationalising strategy and tasked with implementing daily operations, aligned with the company’s strategies.</p>
        <p>Marketing Team Our marketing team promotes our business and drives sales of Lawwa.Asia’s products and services at the same time provides necessary research to identify our target customers and other potential markets.</p>
        <p>Recruitment Team Our greatest strength is our PBT; their skills and dedication are what makes Lawwa.Asia the success it is today. Our recruitment team consists of experienced professionals who have on average over 10 years of recruitment and staffing experience to identify, select and recruit suitable PBT to be part of Lawwa.Asia’s big family.</p>
        <p>Academy Team Our training development team handle the learning and professional development of Lawwa.Asia's workforce. It is our duty to equip our organisation with the knowledge, practical skills and motivation to carry out our work activities effectively..</p>
        <p>Product Development We are always in the process of bringing new products to our clients. Our top priority is to make sure all products are safe to use and at the highest quality. Find out more about our products here.</p>
        <p>Research Development Our research development team develop research programs incorporating current developments to improve existing products and study potential of new products.</p>
        @endif
      </div>
    </div>
  </div>
</section>

<!-- Lawwa Approach -->
<section class="lawwa-approach">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6">
        <div class="img-block">
          <div class="lawwa-table-wrap">
            <div class="lawwa-align-wrap">
              <img src="{{asset('images/frontpages/aboutusimages/'.$page->section_2_image_1)}}" alt="Team">
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <h2 class="section-title">@if (!$page->section_2_heading =='') {!!$page->section_2_heading!!} @else Approach @endif</h2>
        @if (!$page->section_2_content =='') {!!$page->section_2_content!!} @else 
        <p>Lorem ipsum dolor sittem ametamngcing eiusmoad at the sittem sittem eiusmod There are many variations of passages of Lorem Ipsum available, is simply dummy text of the printing and typesetting industry. Lorem Ipsum industry's standard dummy text ever since the 1500s, when unknown printer took a galley of type and scrambled to make a type specimen book.</p>
        <p>typesetting industry. Lorem Ipsum has industry's standard dummy text ever since unknown printer took a galley of type and scrambled it to make a type specimen only five centuries.</p>
        @endif
      </div>
    </div>
  </div>
</section>

<!-- Our Mission -->
<section class="mission-vision">
  <div class="container">
    <div class="row">
      <div class="col-lg-5 order-lg-2 text-lg-right">
        <div class="img-block">
          <div class="lawwa-table-wrap">
            <div class="lawwa-align-wrap">
              @if (!$page->section_3_image =='')
                <img src="{{asset('images/frontpages/aboutusimages/'.$page->section_3_image)}}" alt="Team">
                @else  
                <img src="{{asset('front/assets/images/img6.png')}}" alt="Team">
              @endif
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-7 order-lg-1">
    <h2 class="section-title">@if (!$page->section_3_heading =='') {!!$page->section_3_heading!!} @else Our Mission @endif</h2>
    @if (!$page->section_3_content =='') {!!$page->section_3_content!!} @else 
        <p>Lorem ipsum dolor sittem ametamngcing eiusmoad at the sittem sittem eiusmod There are many variations of passages of Lorem Ipsum available, is simply dummy text of the printing and typesetting industry. Lorem Ipsum industry's standard dummy text ever since the 1500s, when unknown printer took a galley of type and scrambled to make a type specimen book.</p>
        <p>typesetting industry. Lorem Ipsum has industry's standard dummy text ever since unknown printer took a galley of type and scrambled it to make a type specimen only five centuries.</p>
    @endif
      </div>
    </div>
    <div class="row">
      <div class="col-lg-5">
        <div class="img-block">
          <div class="lawwa-table-wrap">
            <div class="lawwa-align-wrap">
              @if (!$page->section_4_image =='')
                <img src="{{asset('images/frontpages/aboutusimages/'.$page->section_4_image)}}" alt="Team">
                @else  
                <img src="{{asset('front/assets/images/img7.png')}}" alt="Team">
              @endif
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-7">
    <h2 class="section-title">@if (!$page->section_4_heading =='') {!!$page->section_4_heading!!} @else Our Vision @endif</h2>
      @if (!$page->section_4_content =='') {!!$page->section_4_content!!} @else 
        <p>Lorem ipsum dolor sittem ametamngcing eiusmoad at the sittem sittem eiusmod There are many variations of passages of Lorem Ipsum available, is simply dummy text of the printing and typesetting industry. Lorem Ipsum industry's standard dummy text ever since the 1500s, when unknown printer took a galley of type and scrambled to make a type specimen book.</p>
        <p>typesetting industry. Lorem Ipsum has industry's standard dummy text ever since unknown printer took a galley of type and scrambled it to make a type specimen only five centuries.</p>
      @endif
      </div>
    </div>
  </div>
</section>

<!-- Lawwa About -->
<section class="lawwa-about-wrap">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-5 order-lg-2">
        <div class="img-block">
          <div class="lawwa-table-wrap">
            <div class="lawwa-align-wrap">
              @if (!$page->section_5_image =='')
                <img src="{{asset('images/frontpages/aboutusimages/'.$page->section_5_image)}}" alt="Team">
                @else  
                <img src="{{asset('front/assets/images/lawwa-about.svg')}}" alt="Team">
              @endif
            </div>            
          </div>
        </div>
      </div> 
      <div class="col-lg-7 order-lg-1">
      <h2 class="section-title">@if (!$page->section_5_heading =='') {!!$page->section_5_heading!!} @else #Lawwa You @endif</h2>
      @if (!$page->section_5_content =='') {!!$page->section_5_content!!} @else 
        <p>Bring out the natural beauty in you. Lawwa.Asia is passionate to help woman feel good and confident with their natural beauty and abilities. Everyone has their own unique features, sizes and personalities; it is our dedication to help ladies set and achieve their beauty goals in the safest and suitable approach. </p>
        <p>This campaign is to create awareness on how to choose the right products for various beauty care treatments amongst woman of all ages, physical appearance and professional backgrounds to achieve the best result for their beauty aspiration.</p>
        <p>The main objective of this campaign is to educate users the importance of choosing a safe beauty product that suits their beauty treatment requirements to avoid short term and long-term hazardous effects on their skin, body and health.</p>
        <p>The approach of this campaign is constant sharing sessions with the public through talks, seminars, webinars, live online and video postings. We will fully utilise most digital platforms such as our website, social media and telecommunication applications.</p>
        <p>To communicate with the bigger audience, we will work a strategic partnership with the mass media to access nation wide publicity reach through news and magazine articles, radio interviews and featured on TV shows.</p>
        <p>This campaign will be an on-going project with the main intention of educating the public on how to accomplish their beauty goals by using safe products, the right treatment and the most suitable approach. Achieving your beauty goal.</p>
      @endif
      </div>      
    </div>
  </div>
</section>
@endif
@endsection