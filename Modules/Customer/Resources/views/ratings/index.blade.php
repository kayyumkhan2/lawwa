@extends('front::layouts.master')
@section('title') {{$pagename}} @endsection
@section('content')

<!-- Lawwa My Account -->
<section class="my-account">
  <div class="container">
    <div class="row">
      @include('customer::includes.sidebar')
      <div class="col-lg-9">
        <div class="right-content content">
           <div class="reviews-ratings">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link show @if( !request()->get('sentrating') ) active @endif " id="pills-received-tab" data-toggle="pill" href="#pills-received" role="tab" aria-controls="pills-received" aria-selected="true">Received</a>
              </li>
              <li class="nav-item">
                <a class="nav-link show @if( request()->get('sentrating') ) active @endif" id="pills-send-tab" data-toggle="pill" href="#pills-send" role="tab" aria-controls="pills-send" aria-selected="false">Sent</a>
              </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade show @if( !request()->get('sentrating') ) active @endif" id="pills-received" role="tabpanel" aria-labelledby="pills-received-tab">
                @if($ReceivedRating->count()>0)
                @foreach($ReceivedRating as $key=> $Rating)
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
                      <span>{{ date ('D , M-Y H:i',strtotime($Rating->created_at))}} </span>
                    </div>
                  </div>
                  <p>{{$Rating->comment}}</p>
                  </div>
                @endforeach
                {{ $ReceivedRating->links() }}
                @else
                <div class="tab-pane fade show @if( !request()->get('sentrating') ) active @endif" id="pills-received" role="tabpanel" aria-labelledby="pills-received-tab">
                  <div class="beautician-review-block">  
                    <p>No Rating found</p>
                  </div>
                </div>
                @endif
                </div>
              @if($SentRating->count()>0)
                <div class="tab-pane fade show @if( request()->get('sentrating') ) active @endif" id="pills-send" role="tabpanel" aria-labelledby="pills-send-tab">
                  @foreach($SentRating as $key=> $sent)  
                  <div class="beautician-review-block">  
                    <div class="beautician-review-inner">
                      <ul>
                        @for ($i=0; $i <$sent->rating ; $i++)
                        <li>
                          <i class="fa fa-star" aria-hidden="true"></i>
                        </li> 
                        @endfor
                      </ul>
                        <span>{{$sent->rating}}.00</span>
                    </div>  
                    <div class="beautician-review-header">
                      <div class="img-block">
                        <img src="{{ asset('public/images/profilepics/'.$sent->receiver->profile_pic) }}" class="rounded-circle" onerror="this.src='/images/usericon.png'" alt="Review">
                      </div>
                      <div class="review-header-content">
                          <h3>{{$sent->receiver->full_name ? $sent->receiver->full_name : "Guest" }}</h3>
                          <span>{{ date ('D , M-Y H:i',strtotime($sent->created_at))}} </span>
                      </div>
                    </div>
                    <p>{{$sent->comment}}</p>
                  </div>
                  @endforeach
                  {{ $SentRating->links() }}
                </div>
                @else
                <div class="tab-pane fade show @if( request()->get('sentrating') ) active @endif" id="pills-send" role="tabpanel" aria-labelledby="pills-send-tab">
                  <div class="beautician-review-block">  
                    <p>No Rating found</p>
                  </div>
                </div>  
              @endif           
          </div>
        </div>
      </div>
      </div>
    </div>
  </div>
</section>
@endsection