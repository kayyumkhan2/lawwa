@extends('front::layouts.master')
@section('title') {{$pagename}} @endsection
@section('content')                           
<section class="lawwa-page-title" style="background-image: url({{asset('front/assets/images/backgrounds/academy.png')}})">
  <div class="container">
    <h2>{{$pagename}}</h2>
    <h6>Lawwa.Asia, Your Personal Beauty Therapist</h6>
    <h4>Stay Lawwa, Beauty Goal Getter</h4>
  </div>
</section>

<!-- Lawwa Team -->
@if ($Academy =='')
<section class="lawwa-academy">
  <div class="container">    
    <div class="academy-info">
      <div class="img-block">
        <img src="{{asset('front/assets/images/academy-img.png')}}" alt="Team">
      </div>
      <div class="academy-content">
        <h2 class="section-title">Academy</h2>
        <p>Personal Beauty Therapists Lawwa.Asia is dedicated in providing top quality Personal Beauty Therapists (PBT) to your desired location and perform various non-medical face and body treatments using the safest technology, products and approach. Our PBT are able to advise clients on suitable treatments to achieve the best results.</p>
        <p>Interview Sessions We are always on the look-out for potential candidates to join Lawwa.Asia as a PBT. We will conduct an interview session for each candidate to ensure they are ready and suitable to participate in our exclusive training program. Our interview sessions are done in both ways; groups and individually.</p>
        <p>Training Sessions We provide exclusive training sessions for potential PBT candidates who have met the requirements during our interview session. Our training course and qualification as a Personal Beauty Therapist is registered under the HRDF Strategic Initiative Training Scheme in collaboration with established training providers.</p>
        <p>Inhouse Trainers At Lawwa.Asia, our training programs are developed by our inhouse trainers based on professional practice used by the industry. Our trainers are also certified with years of experience in their specialised expertise.</p>
        <p>Career Path At Lawwa.Asia, PBT is an exciting and rewarding career where you can schedule appointments that are most convenient for you. You will be given training on gaining essential skills and qualities to become an aspiring PBT. With us, you are able to grow and venture your career as a PBT, beauty entrepreneur, beauty trainer and even a beauty consultant</p>
        <p>CPD Hours CPD (Continuing Professional Development) Hours requirements for our PBT is 40 hours for them to develop professional skills and knowledge through interactive, participation-based or independent learning. This is to improve and broaden their knowledge and skills at the same time to develop the personal qualities and competencies required in their working line.</p>
        <span class="text-bold">We create real opportunities for women of B40 to generate sustainable income through Lawwa.Asia beauty-preneur programs.</span>
      
      </div>
    </div>
  </div>
</section>
 @else
 <section class="lawwa-academy">
  <div class="container">    
    <div class="academy-info">
      <div class="img-block">
          <img src="{{asset('images/frontpages/academy/'.$Academy->section_1_image)}}" alt="Team">
      </div>
      <div class="academy-content">
        <h2 class="section-title">{!!$Academy->section_1_heading!!}</h2>
          {!!$Academy->section_1_content!!}
      </div>
    </div>
  </div>
</section>
 @endif 

<!-- Lawwa Courses -->
@if(count($AcademyCourse)>0)
<section class="lawwa-Courses">
  <div class="container">
    <h2 class="section-title">@if(!$Academy=="") {!!$Academy->section_2_heading!!} @else Courses @endif </h2>
     @if(!$Academy=="") {!!$Academy->section_2_content!!}  @else Lorem Ipsum has industry's standard dummy text ever since 1500s, when unknown printer took a galley of type and scrambled it to make a type specimen book. survived only five centuries.  @endif 
    <div class="course-block">
       <div class="owl-carousel">
      @if(count($AcademyCourse)>0)
      @foreach($AcademyCourse as $Courses)
      <div class="item">
          <figure>
            <a href="{{route('pages.course-details',['id'=>$Courses->id])}}" class="img-block stretched-link">
              <i class="fa fa-eye" aria-hidden="true"></i>
              <div class="lawwa-table-wrap">
                <div class="lawwa-align-wrap">
                  <img src="{{asset('images/frontpages/academycourses/'.$Courses->image)}}" class="w-100" alt="Course">
                </div>
              </div>
            </a>
            <figcaption>
              <h6>{{$Courses->heading}}</h6>
              <h4>RM {{$Courses->price}}</h4>
              <!-- <a href="javascript:void(0)" class="lawwa-btn AddToCartProduct" data-product_id="1"> Buy Now</a> -->
              <form action="{{route('selected.course.plans')}}" method="post">
                @csrf
                <input type="text" name="course_id" hidden="" class="course_id" value="{{$Courses->id}}">
                <input type="text" name="course" hidden="" class="course" value="{{$Courses->heading}}">
                <input type="text" name="price" hidden="" value="{{$Courses->price}}">
                <button type="submit" class="lawwa-btn d-block w-100"> <i class="fa fa-shopping-cart" aria-hidden="true"></i> Buy</button>
                <!-- <a href="javascript:void(0);" class="lawwa-btn d-block w-100"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Buy</a> -->
            </form>
            </figcaption>
          </figure>
        </div>
      @endforeach
      @endif  
      </div>
      <!-- <div class="btn-block">
        <a href="#0" class="lawwa-btn">Load More</a>
      </div> -->
    </div>
  </div>
</section>
@endif 
@if(count($certificates)>0)
<!-- Lawwa Certificates -->
<section class="lawwa-Courses">
  <div class="container">
    <h2 class="section-title">@if(!$Academy=="") {!!$Academy->section_3_heading!!} @else Certificates @endif </h2>
     @if(!$Academy=="") {!!$Academy->section_3_content!!}  @else Lorem Ipsum has industry's standard dummy text ever since 1500s, when unknown printer took a galley of type and scrambled it to make a type specimen book. survived only five centuries.  @endif 
    <div class="course-block">
       <div class="owl-carousel">
      @if(count($certificates)>0)
      @foreach($certificates as $certificate)
      <div class="item">
          <figure>
            <a href="{{route('pages.certificate-details',['id'=>$certificate->id])}}" class="img-block stretched-link">
              <i class="fa fa-eye" aria-hidden="true"></i>
              <div class="lawwa-table-wrap">
                <div class="lawwa-align-wrap">
                  <img src="{{asset('images/frontpages/certificates/'.$certificate->image)}}" class="w-100" alt="Course">
                </div>
              </div>
            </a>
            <figcaption>
              <h6>{{$certificate->heading}}</h6>
              <h4>RM {{$certificate->price}}</h4>
              <!-- <a href="javascript:void(0)" class="lawwa-btn AddToCartProduct" data-product_id="1"> Buy Now</a> -->
              <form action="{{route('selected.certificates.plans')}}" method="post">
                  @csrf
                  <input type="text" name="certificate_id" hidden="" class="course_id" value="{{$certificate->id}}">
                  <input type="text" name="certificate" hidden="" class="certificate" value="{{$certificate->heading}}">
                  <input type="text" name="price" hidden="" value="{{$certificate->price}}">
                  <button type="submit" class="lawwa-btn d-block w-100"> <i class="fa fa-shopping-cart" aria-hidden="true"></i> Apply</button>
                  <!-- <a href="javascript:void(0);" class="lawwa-btn d-block w-100"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Buy</a> -->
            </form>
            </figcaption>
          </figure>
        </div>
      @endforeach
      @endif  
      </div>
      <!-- <div class="btn-block">
        <a href="#0" class="lawwa-btn">Load More</a>
      </div> -->
    </div>
  </div>
</section>
@endif 
<!-- Lawwa Facilities -->
<section class="facilities">
  <div class="container">
    <h2 class="section-title">@if(!$Academy=="") {!!$Academy->section_4_heading!!} @else Facilities @endif </h2>
     @if(!$Academy=="") {!!$Academy->section_4_content!!}  @else Lorem Ipsum has industry's standard dummy text ever since 1500s, when unknown printer took a galley of type and scrambled it to make a type specimen book. survived only five centuries.  @endif
    <div class="facilitie-block">
      <div class="owl-carousel">
      @if(count($AcademyFaculty)>0)
        @foreach($AcademyFaculty as $Faculty)
        <div class="item">
          <a href="{{route('pages.academy-facilities-details',['id'=>$Faculty->id])}}" class="facilitie-item">
            <div class="img-block">
              <div class="table-wrap">
                <div class="align-wrap">
                  <img src="{{asset('images/frontpages/academyfaculty/'.$Faculty->image)}}" class="w-100" alt="facilitie">
                </div>
              </div>
            </div>
            <div class="facilitie-info">
              <span>{!! $Faculty->heading !!}</span>
            </div>
          </a>
        </div>
        @endforeach
      @else
        <div class="item">
          <a href="#0" class="facilitie-item">
            <div class="img-block">
              <div class="table-wrap">
                <div class="align-wrap">
                  <img src="front/assets/images/facilitie2.png" class="w-100" alt="facilitie">
                </div>
              </div>
            </div>
            <div class="facilitie-info">
              <span>Hair Expert</span>
            </div>
          </a>
        </div>
        <div class="item">
          <a href="#0" class="facilitie-item">
            <div class="img-block">
              <div class="table-wrap">
                <div class="align-wrap">
                  <img src="front/assets/images/facilitie3.png" class="w-100" alt="facilitie">
                </div>
              </div>
            </div>
            <div class="facilitie-info">
              <span>Makeup Artist</span>
            </div>
          </a>
        </div>
        <div class="item">
          <a href="#0" class="facilitie-item">
            <div class="img-block">
              <div class="table-wrap">
                <div class="align-wrap">
                  <img src="front/assets/images/facilitie1.png" class="w-100" alt="facilitie">
                </div>
              </div>
            </div>
            <div class="facilitie-info">
              <span>Beauty Skin Expert</span>
            </div>
          </a>
        </div>
        <div class="item">
          <a href="#0" class="facilitie-item">
            <div class="img-block">
              <div class="table-wrap">
                <div class="align-wrap">
                  <img src="front/assets/images/facilitie2.png" class="w-100" alt="facilitie">
                </div>
              </div>
            </div>
            <div class="facilitie-info">
              <span>Hair Expert</span>
            </div>
          </a>
        </div>
        <div class="item">
          <a href="#0" class="facilitie-item">
            <div class="img-block">
              <div class="table-wrap">
                <div class="align-wrap">
                  <img src="front/assets/images/facilitie3.png" class="w-100" alt="facilitie">
                </div>
              </div>
            </div>
            <div class="facilitie-info">
              <span>Normal Pregnancy</span>
            </div>
          </a>
        </div>
      @endif  
      </div>
    </div>
  </div>
</section>

@endsection