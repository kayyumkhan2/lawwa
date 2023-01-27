@extends('front::layouts.master')
@section('title') {{$pagename}} @endsection
@section('content')
  
<!-- Lawwa Page Title -->                 
<section class="lawwa-page-title" style="background-image: url({{asset('front/assets/images/backgrounds/gallery.png')}})">
  <div class="container">       
    <h2>{{$pagename}}</h2>
    <h6>Lawwa.Asia, Your Personal Beauty Therapist</h6>
    <h4>Lawwa.Asia Moments, captured it all</h4>
  </div>
</section>

<!-- News -->
<section class="lawwa-news">
  <div class="container">
    <h2 class="section-title">News</h2>
    <div class="news-block">
      <div class="row">
        @if(count($GalleryNews)>0)
        @foreach($GalleryNews as $news)
        <div class="col-lg-4 col-sm-6">
          <div class="news-contant">
          <a href="{{route('pages.news-details',['id'=>$news->id])}}" class="news-wrap">
            <div class="img-block">
              <div class="lawwa-table-wrap">
                <div class="lawwa-align-wrap">
                  <img src="{{asset('images/frontpages/gallerynews/'.$news->image)}}" class="w-100" alt="News">
                </div>
              </div>
            </div>
            <div class="news-info">
              <span class="news-date">{{date_format($news->created_at ,"M d")}} , {{date_format($news->created_at ,"Y")}}</span>
              <h4>{{$news->heading}}</h4>
              <p>{!! \Illuminate\Support\Str::limit($news->content, 100, '...') !!}
              </p>
              @if (strlen(strip_tags($news->content)) > 50)
                <a href="{{route('pages.news-details',['id'=>$news->id])}}" class="lawwa-btn">Read More</a>
              @endif
            </div>
          </a>
        </div>
        </div>
        @endforeach
        @endif
      </div>
    </div>
    {{ $GalleryNews->links() }}
  </div>
</section>

<!-- Photo -->
<section class="lawwa-photos">
  <div class="container">
    <h2 class="section-title">Photos</h2>
    <div class="photo-block">
      <div class="row">
      @if(count($GalleryPhotos)>0)
      @foreach($GalleryPhotos as $Photos)
         <div class="col-lg-4 col-sm-6">
          <figure>
            <div class="img-block">
              <div class="lawwa-table-wrap">
                <div class="lawwa-align-wrap">
                  <img src="{{asset('images/frontpages/galleryphotos/'.$Photos->image)}}" class="w-100" alt="Photo">
                </div>
              </div>
              <a href="#0" class="search-icon">
                <span><img src="{{asset('images/frontpages/galleryphotos/'.$Photos->image)}}" alt="search-icon"></span>
              </a>
            </div>
            <figcaption>
              <h6>{{$Photos->heading}}</h6>
            </figcaption>
          </figure>
        </div>
      @endforeach
      @else
      <div class="col-lg-4 col-sm-6">
          <figure>
            <div class="img-block">
              <div class="lawwa-table-wrap">
                <div class="lawwa-align-wrap">
                  <img src="{{asset('front/assets/images/photo1.png')}}" class="w-100" alt="Photo">
                </div>
              </div>
              <a href="#0" class="search-icon">
                <span><img src="{{asset('front/assets/images/photo1.png')}}"  alt="search-icon"></span>
              </a>
            </div>
            <figcaption>
              <h6>Eyes Set</h6>
            </figcaption>
          </figure>
        </div>
        <div class="col-lg-4 col-sm-6">
          <figure>
            <div class="img-block">
              <div class="lawwa-table-wrap">
                <div class="lawwa-align-wrap">
                  <img src="{{asset('front/assets/images/photo2.png')}}" class="w-100" alt="Photo">
                </div>
              </div>
              <a href="#0" class="search-icon">
                <span><img src="{{asset('front/assets/images/photo2.png')}}" alt="search-icon"></span>
              </a>
            </div>
            <figcaption>
              <h6>Eye Makeup</h6>
            </figcaption>
          </figure>
        </div>
        <div class="col-lg-4 col-sm-6">
          <figure>
            <div class="img-block">
              <div class="lawwa-table-wrap">
                <div class="lawwa-align-wrap">
                  <img src="{{asset('front/assets/images/photo3.png')}}" class="w-100" alt="Photo">
                </div>
              </div>
              <a href="#0" class="search-icon">
                <span><img src="{{asset('front/assets/images/photo3.png')}}" alt="search-icon"></span>
              </a>
            </div>
            <figcaption>
              <h6>Makeup Look</h6>
            </figcaption>
          </figure>
        </div>
        <div class="col-lg-4 col-sm-6">
          <figure>
            <div class="img-block">
              <div class="lawwa-table-wrap">
                <div class="lawwa-align-wrap">
                  <img src="{{asset('front/assets/images/photo4.png')}}" class="w-100" alt="Photo">
                </div>
              </div>
              <a href="#0" class="search-icon">
                <span><img src="{{asset('front/assets/images/photo4.png')}}" alt="search-icon"></span>
              </a>
            </div>
            <figcaption>
              <h6>Eye Makeup</h6>
            </figcaption>
          </figure>
        </div>
        <div class="col-lg-4 col-sm-6">
          <figure>
            <div class="img-block">
              <div class="lawwa-table-wrap">
                <div class="lawwa-align-wrap">
                  <img src="{{asset('front/assets/images/photo5.png')}}" class="w-100" alt="Photo">
                </div>
              </div>
              <a href="#0" class="search-icon">
                <span><img src="{{asset('front/assets/images/photo5.png')}}" alt="search-icon"></span>
              </a>
            </div>
            <figcaption>
              <h6>Eye Makeup</h6>
            </figcaption>
          </figure>
        </div>
        <div class="col-lg-4 col-sm-6">
          <figure>
            <div class="img-block">
              <div class="lawwa-table-wrap">
                <div class="lawwa-align-wrap">
                  <img src="{{asset('front/assets/images/photo6.png')}}" class="w-100" alt="Photo">
                </div>
              </div>
              <a href="#0" class="search-icon">
                <span><img src="{{asset('front/assets/images/photo6.png')}}" alt="search-icon"></span>
              </a>
            </div>
            <figcaption>
              <h6>Makeup Look</h6>
            </figcaption>
          </figure>
        </div>
      @endif
      </div>
      <div class="btn-block">
        {{ $GalleryPhotos->links() }}
      </div>
    </div>
  </div>

</section>
<style type="text/css">
  .clickToPlay
  {
    background-color: green !important;
  }

</style>
<!-- Lawwa Video -->
<section class="lawwa-video">
  <div class="container">
    <h2 class="section-title">Video</h2>
    <div class="video-wrap">
      <div class="row">
    @if(count($GalleryVideos)>0)
      @foreach($GalleryVideos as $Videos)
        <div class="col-lg-4 col-sm-6">
          <figure>
           <video width="100%" height="auto" class="w3-border w3-padding" controls>
              <source src="{{asset('images/frontpages/galleryvideos/'.$Videos->video)}}" type="video/mp4">
              <source src="{{asset('images/frontpages/galleryvideos/'.$Videos->video)}}" type="video/ogg">
               Your browser does not support the video tag.
          </video>
          </figure> 
        </div>
      @endforeach
        <div class="btn-block">
        {{ $GalleryVideos->links() }}
      </div>
      @else
        <div class="col-lg-4 col-sm-6">
          <figure>
            <div class="img-block">
              <div class="lawwa-table-wrap">
                <div class="lawwa-align-wrap">
                  <img src="{{asset('front/assets/images/video1.png')}}" class="w-100" alt="Video">
                </div>
              </div>
            </div>
            <figcaption>
              <a href="#0" class="video-btn "><i class="fa fa-play" aria-hidden="true"></i></a>
            </figcaption>
          </figure>
        </div>
        <div class="col-lg-4 col-sm-6">
          <figure>
            <div class="img-block">
              <div class="lawwa-table-wrap">
                <div class="lawwa-align-wrap">
                  <img src="{{asset('front/assets/images/video1.png')}}" class="w-100" alt="Video">
                </div>
              </div>
            </div>
            <figcaption>
              <a href="#0" class="video-btn "><i class="fa fa-play" aria-hidden="true"></i></a>
            </figcaption>
          </figure>
        </div>
        <div class="col-lg-4 col-sm-6">
          <figure>
            <div class="img-block">
              <div class="lawwa-table-wrap">
                <div class="lawwa-align-wrap">
                  <img src="{{asset('front/assets/images/video1.png')}}" class="w-100" alt="Video">
                </div>
              </div>
            </div>
            <figcaption>
              <a href="#0" class="video-btn "><i class="fa fa-play" aria-hidden="true"></i></a>
            </figcaption>
          </figure>
        </div>
        <div class="col-lg-4 col-sm-6">
          <figure>
            <div class="img-block">
              <div class="lawwa-table-wrap">
                <div class="lawwa-align-wrap">
                  <img src="{{asset('front/assets/images/video1.png')}}" class="w-100" alt="Video">
                </div>
              </div>
            </div>
            <figcaption>
              <a href="#0" class="video-btn "><i class="fa fa-play" aria-hidden="true"></i></a>
            </figcaption>
          </figure>
        </div>
      @endif
      </div>
      <!-- <div class="btn-block">
        <a href="#0" class="lawwa-btn">Load More</a>
      </div> -->
    </div>
  </div>
</section>

@endsection