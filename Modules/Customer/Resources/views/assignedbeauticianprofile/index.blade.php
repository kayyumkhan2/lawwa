@extends('front::layouts.master')
@section('title') {{$pagename}} @endsection
@section('content')
<!-- Lawwa My Account -->
<section class="assigned-beautician">
  <div class="container">
    <div class="row">
      @include('customer::includes.sidebar')
      <div class="col-lg-9">
        <div class="right-content content">
          <div class="assigned-beautician-inner">
            <div class="assigned-profile">
              <div class="img-block">
                  <img src="{{ asset('public/images/profilepics/'.$Beautician->profile_pic) }}" onerror="this.src='/images/usericon.png'"  alt="Profile">
              </div>
              <div class="assigned-profile-info">
                <h3>{{$Beautician->full_name}}</h3>
                <div class="assigned-profile-review">
                <ul>
                  <?php
                    $totalRating = 5;
                    $starRating = round(2*($Beautician->UserReviewGet)->avg('rating') )/2;
                    for ($i = 1; $i <= $totalRating; $i++) {
                         if($starRating < $i ) {
                            if(is_float($starRating) && (round($starRating) == $i)){
                                echo '<li><i class="fa fa-star-half-o" aria-hidden="true"></i></li>';
                            }else{
                                echo '<li><i class="fa fa-star-o" aria-hidden="true"></i></li>';
                            }
                         }else {
                            echo '<li><i class="fa fa-star" aria-hidden="true"></i></li>';
                        }
                      }
                    ?>
                  </ul>
                  <span>{{round(($Beautician->UserReviewGet)->avg('rating'),1)}}</span>
                </div>
                <span>Total Bookings: {{$Beautician->BookingAssign()->where('current_status','Completed')->count()}}</span>                
                <h4>Description</h4>
                <p>
                  @if($Beautician->UserProfileInformation!="")
                    {{$Beautician->UserProfileInformation->About_us}}
                  @endif
                </p>
              </div>
            </div>
            <div class="assigned-beautician-gallery">
              <h2 class="section-title">Gallery</h2>
              <div class="row">
              @foreach($BeauticianGallery as $images)
                <div class="col-md-3 col-6">
                  <div class="img-block">
                    <div class="lawwa-table-wrap">
                      <div class="lawwa-align-wrap">
                        <a href="#0"><img src="{{ asset('images/beauticiangalleryimages/'.$images->image) }}" alt="Gallery"></a>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
              </div>
            </div>
            <div class="assigned-beautician-services">
              <h2 class="section-title">Services</h2>
              <ul>
                @if(!$Beautician->BeauticianServices->isEmpty())                                        
                    @foreach($Beautician->BeauticianServices as $key=> $Services )
                      @if ($loop->odd)
                        <li><a href="#0" class="link">{{$Services->ServiceInfo->name}}</a></li>
                      @endif
                    @endforeach
                @endif
              </ul>
              <ul>
                @if(!$Beautician->BeauticianServices->isEmpty())                                        
                    @foreach($Beautician->BeauticianServices as $key=> $Services )
                      @if ($loop->even)
                        <li><a href="#0" class="link">{{$Services->ServiceInfo->name}}</a></li>
                      @endif
                    @endforeach
                @endif
              </ul>
            </div>
            <div class="assigned-beautician-review">              
              <h2 class="section-title">Reviews and ratings</h2>
              <div class="rating-bar">
                <div class="row">
                  <div class="col-md-2 col-sm-3 col-6">
                    <h2>{{round(($Beautician->UserReviewGet)->avg('rating'),1)}}</h2>
                    <span>Out of 5</span>
                  </div>
                  <div class="col-md-3 col-sm-4 col-6">
                    <?php     
                       $tot_stars = $rating_counts->sum('rating');
                      foreach ($rating_counts->sortBy('rating') as $key => $value) {
                        if ($value->rating_count>0) {
                          $count =  $value->rating_count;
                          $percent = $count * 100 / $tot_stars;
                        }
                        else
                        {
                          $percent =0;
                          $count =0;
                        }
                        ?>
                    <div class="rating-star">
                      <ul>{{round($percent,1)}} %
                        @for($i=1;$i<=$value->rating; $i++)
                        <li>
                          <i class="fa fa-star" aria-hidden="true"></i>
                        </li>
                        @endfor
                      </ul>
                    </div>
                    <?php 
                        }
                      ?> 
                  </div>
                  <div class="col-md-7">
                    <div class="progress-wrap">
                      <?php     
                         $tot_stars = $rating_counts->sum('rating');
                        foreach ($rating_counts->sortBy('rating') as $key => $value) {
                          if ($value->rating_count>0) {
                            $count =  $value->rating_count;
                            $percent = $count * 100 / $tot_stars;
                          }
                          else
                          {
                            $percent =0;
                            $count =0;
                          }
                          ?>
                          <div class="progress-item-wrap">
                            <div class="progress-item">                    
                              <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="{{round($percent,2)}}" aria-valuemin="0" aria-valuemax="100"></div>                    
                              </div>                    
                            </div>
                          </div>
                       <?php 
                        }
                      ?> 
                    </div>
                  </div>
                </div>  
              </div>
              @if($Beautician->UserReviewGet->count()>0)
              @foreach($Beautician->UserReviewGet as $key=> $Rating)
                <div class="beautician-review-block">  
                  <div class="beautician-review-inner">
                    <ul>
                      @for ($i=0; $i <$Rating->rating ; $i++)
                      <li>
                        <i class="fa fa-star" aria-hidden="true"></i>
                      </li> 
                      @endfor
                    </ul>
                    <span>{{$Rating->rating}}.00</span>
                  </div>  
                  <div class="beautician-review-header">
                    <div class="img-block">
                      <img src="{{ asset('public/images/profilepics/'.$Rating->sender->profile_pic) }}" class="rounded-circle" onerror="this.src='/images/usericon.png'" alt="Review">
                    </div>
                    <div class="review-header-content">
                      <h3>{{$Rating->sender->full_name}}</h3>
                      <span>{{ date ('D , M-Y H:i',strtotime($Rating->created_at))}}</span>
                    </div>
                  </div>
                  <p>{{$Rating->comment}}</p>
                </div>
                @endforeach
                @endif
             <!--  <div class="read-all">
                <a href="#0" class="link">Read All</a>
              </div> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


@endsection