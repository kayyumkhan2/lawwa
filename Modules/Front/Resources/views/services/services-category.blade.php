@extends('front::layouts.master')
@section('title') Services-Category @endsection
@section('content')
<!-- Lawwa Page Title -->
<section class="lawwa-page-title" style="background-image: url({{ asset('front/assets/images/backgrounds/services.png')}})">

  <div class="container">
    <h2>Services</h2>
    <h6>Lawwa.Asia, Your Personal Beauty Therapist</h6>
    <h4>Your Beauty Treatments, Lawwa is within you</h4>
  </div>
</section>



<!-- Lawwa Services -->
<section class="services">
  <div class="tabs-background" style="background-image: url({{ asset('front/assets/images/backgrounds/bg-background.png')}});">
    <div class="container">                             
      <ul class="nav nav-tabs owl-carousel" id="myTab" role="tablist">
        <li class="nav-item item" role="presentation">
          <a class="nav-link active" id="all-tab" onclick="changeClass()" data-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="true">All</a>
        </li>
         @if (count($ServiceCategories) > 0)
         @foreach($ServiceCategories as $key=>$ServiceCategory)
        <li class="nav-item item" role="presentation" id="all-tab">
          <a class="nav-link" id="{{$ServiceCategory->name}}-tab" onclick="changeClass()" data-toggle="tab" href="#tab-{{$key}}" role="tab" aria-controls="facial" aria-selected="false">{{$ServiceCategory->name}} </a>
        </li>
        @endforeach
        @endif
      </ul>
    </div>
  </div>
  <div class="container">    
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
        <div class="service-wrap">
          <div class="row">
             @if (count($ServiceCategories) > 0)
               @foreach($ServiceCategories as  $ServiceCategory)
              <div class="col-lg-4 col-sm-6">
                @if(count($ServiceCategory->subcategory)>0)  
                  <a href="{{route('services.servicessubcategory',$ServiceCategory->id)}}" class="service-item">
                  <i class="fa fa-eye" aria-hidden="true"></i>
                @else
               <a href="{{route('services',$ServiceCategory->id)}}" class="service-item">
               <i class="fa fa-eye" aria-hidden="true"></i>
              @endif 
                <div class="img-block">
                  <div class="table-wrap">
                    <div class="align-wrap">
                      <img src="{{ asset('public/images/categoriesimages/'.$ServiceCategory->image) }}" alt="service">
                    </div>
                  </div>
                </div>
                <div class="service-info">
                  <span>{{$ServiceCategory->name}} </span>
                </div>
              </a>
            </div>
            @endforeach
          @endif 
          </div>
        </div>
      </div>
      @if (count($ServiceCategories) > 0)
           @foreach($ServiceCategories as $data=>$ServiceCategory)
            <div class="tab-pane fade" id="tab-{{$data}}" role="tabpanel" aria-labelledby="{{$ServiceCategory->name}}-tab">
              <div class="service-wrap">
                <div class="row">
                  @foreach($ServiceCategory->CategoryService as $Services)
                    <div class="col-lg-4 col-sm-6">
                      <a href="{{route('addservicecarttocart',[$Services->id,'id'=>$ServiceCategory->id])}}" class="service-item">
                        <div class="img-block">
                          <div class="table-wrap">
                            <div class="align-wrap">
                              <img src="{{ asset('public/images/serviceimages/'.$Services->service_image) }}" alt="{{$Services->service_image}}">
                            </div>
                          </div>
                        </div>
                        <div class="service-info">
                          <span>{{$Services->name}}</span>
                        </div>
                      </a>
                    </div>
                  @endforeach
                
                @foreach($ServiceCategory->subcategory as $sub=>$subcategory)
                <div class="col-lg-4 col-sm-6">
                  <a href="{{route('services',$subcategory->id)}}" class="service-item">
                    <div class="img-block">
                      <div class="table-wrap">
                        <div class="align-wrap">
                          <img src="{{ asset('public/images/categoriesimages/'.$subcategory->image) }}" alt="service">
                        </div>
                      </div>
                    </div>
                    <div class="service-info">
                      <span>{{$subcategory->name}} </span>
                    </div>
                  </a>
                </div>
                @endforeach
               </div>
             </div>
          </div>
        @endforeach
      @endif
    </div>
  </div>
</section>
@jquery
@toastr_js
@toastr_render
@endsection
@section('js')
<script type="text/javascript">
    function changeClass(){
        document.querySelector('#myTab a.active').classList.remove('active');
    }
</script> 
@endsection