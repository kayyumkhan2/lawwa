@extends('front::layouts.master')
@section('title') {{$pagename}} @endsection
@section('content')
<section class="upcoming-service-detail">
  <div class="container">
    <div class="row">
      @include('beautician::includes.sidebar')
      <div class="col-lg-9">
        <div class="right-content content">
          <div class="order-info">
            <div class="upcoming-order">
              <h5>{{$pagename}}</h5>
              <div class="row">
                <div class="col-md-12">
                  <div class="user-detail">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">Full Name</th>
                          <th scope="col">Phone No</th>
                          <th scope="col">Email </th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($Booking->BookingUsers as $user)
                        <tr class="table-white">
                          <td>{{ucfirst($user->full_name)}}</td>
                          <td>{{ucfirst($user->phone_no)}}</td>
                          <td>{{ucfirst($user->email)}}</td>
                        </tr>
                      @endforeach    
                      </tbody>
                    </table>
                  </div>
                  <span class="add-edit-type">Address</span>              
                    <p>{{$Booking->location}}</p>
                    <div class="phone-number">
                      <span class="label">Booking Type</span>
                      <span>{{ucfirst($Booking->type)}}</span>
                    </div>
                </div>
                <div class="col-md-12">
                  <div class="right-booking-info">
                    @php 
                      $current_datetime = date('Y-m-d');
                      $current_datetime = gmdate("Y-m-d", strtotime($current_datetime));  
                      $BookingEndDate = gmdate("Y-m-d", strtotime($Booking->date)); 
                    @endphp  
                  <span>{{$Booking->date}} <b>{{ strtoupper(parseDateTime($Booking->date)->format('l'))}}</b></span>
                  <span>Start {{ date ('H:i',strtotime($Booking->start_time))}} End {{ date ('H:i',strtotime($Booking->end_time))}} </span>
                    <a href="{{route('beautician.ratings.create',['id'=>$Booking->id])}}"><i class="fa fa-star" aria-hidden="true"></i> Rate &amp; Review</a>
                  </div>
                @if(strtotime($current_datetime) <= strtotime($BookingEndDate))
                  <form method="post" action="{{route('beautician.bookings.bookingstatuschange',$Booking->id)}}">
                    @csrf
                  <div class="right-booking-info">
                    <label>{{$Booking->current_status}}</label>
                      @if ($Booking->current_status!="PaymentFailed" && $Booking->current_status!="Pending" && $Booking->current_status!="Cancel" && $Booking->current_status!="Completed" && $Booking->current_status!="Refunded") 
                          <select class="form-control" name="status">
                            @if(strtotime($current_datetime) == strtotime($BookingEndDate))
                              <option value='Reached' class="form-control" {{$Booking->current_status == 'Reached'  ? 'selected' : ''}}>Reached</option>
                              <option value='OnTheWay' class="form-control" {{$Booking->current_status == 'OnTheWay'  ? 'selected' : ''}}>On The Way</option>
                            @endif  
                            <option value='Accepted' class="form-control" {{$Booking->current_status == 'Accepted'  ? 'selected' : ''}}>Accepted</option>
                          <!--
                          <option value='Start' class="form-control" {{$Booking->current_status == 'Start'  ? 'selected' : ''}}>Start</option>
                           -->                     
                            @if ($Booking->current_status=="Scanned" || $Booking->current_status=="Temperature uploaded" )
                              @if(strtotime($current_datetime) == strtotime($BookingEndDate))  
                                <option value='Completed' class="form-control" {{$Booking->current_status == 'Completed'  ? 'selected' : ''}}>Completed
                                </option>
                              @endif
                            @endif
                          </select>  
                      @endif
                  </div>
                  @if ($Booking->current_status!="PaymentFailed" && $Booking->current_status!="Pending" && $Booking->current_status!="Cancel" && $Booking->current_status!="Completed" && $Booking->current_status!="Refunded" ) 
                  <div class="btn-block">
                    <br>
                    <button type="submit" class="lawwa-btn lawwa-pink-btn">Update</button>
                  </div>
                  @endif 
                </form>
                @endif 
                <br>
                @if($Booking->current_status=='Cancel' && $Booking->BookingCancelReason!="" )
                  <div class="card">
                      <div class="card-header"><b class="text-danger">Cancel Reason</b> : {{$Booking->BookingCancelReason->reason}}</div> 
                      <div class="card-body">
                        {{$Booking->BookingCancelReason->comment}}
                      </div>
                    </div>
                  @endif
              </div>
            </div>
            <div class="schedule-service">
              <h3>Schedule Service</h3>
              <div class="row">
                @foreach($Booking->ServiceDetails as $services)
                <div class="col-xl-6 col-md-6 col-sm-6">
                  <a href="#0" class="service-item">
                    <div class="img-block">
                      <div class="table-wrap">
                        <div class="align-wrap">
                          <img src="{{ asset('public/images/serviceimages/'.$services->service_image) }}" alt="service">
                        </div>
                      </div>
                    </div>
                    <div class="service-info">
                      <h6>{{$services->name}}</h6>
                      <span><img src="{{ asset('front/assets/images/icons/watch-icon.svg')}}" alt="Icon" class="mr-2" width="18">@if($services->houre>0){{$services->houre}} H : @endif  {{$services->minute+5}} Min.</span>
                      <span class="price">RM {{$services->amount}}</span>
                    </div>
                  </a>
                </div>
                @endforeach
              </div>
              <div class="notes">
                <h3>Customer Notes</h3>
                <p>{{$Booking->note}}</p>
              </div>
              <!-- <div class="sarvice-cost">
                <h3>Service Cost </h3>
                <p>Cash on arrival</p>
              </div> -->
             <div class="row">
              @if(!$Booking->BookingVideos->isEmpty())
                 @foreach($Booking->BookingVideos as $Videos)
                  <div class="col-lg-4 col-sm-6">
                    <figure>
                     <video width="320" height="240" class="w3-border w3-padding" controls>
                        <source src="{{asset('videos/'.$Videos->file_name)}}" type="video/mp4">
                        <source src="{{asset('videos/'.$Videos->file_name)}}" type="video/ogg">
                         Your browser does not support the video tag.
                    </video>
                    </figure> 
                  </div>
                @endforeach
              @endif  
            </div>
             @if ($Booking->current_status!="PaymentFailed" && $Booking->current_status!="Pending" && $Booking->current_status!="Cancel" && $Booking->current_status!="Completed" && $Booking->current_status!="Refunded" && $Booking->current_status!="Temperature uploaded"  && $Booking->current_status!="Assigned")
             <div class="btn-block">
                <a href="{{route('beautician.bookings.temperature.upload',$Booking->id)}}" class="lawwa-btn lawwa-pink-btn">Upload Temperature</a>
                @if($Booking->BookingVideos->isEmpty())
                  <a href="JavaScript:void(0);"  class="lawwa-btn" data-toggle="modal" data-target="#exampleModalCenter">Upload Video</a>
                @endif             
              </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Record video</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- <div class="container-fluid">
          <video id="preview" class="p-1 border" style="width:100%;"></video>
            <div class="btn-group btn-group-toggle mb-5" data-toggle="buttons">
              
            </div>
        </div> -->
        <div class="container-fluid">
              <video id="preview" style="width:100%;" autoplay class="p-1 border" ></video><br/><br/>
              <div class="btn-group">
                  <div id="startButton" class="lawwa-btn ml-2 " > Start </div>
                  <div id="stopButton" class="lawwa-btn ml-2"  style="display:none;"> Stop </div>
              </div>
          </div>
          <div class="col-md-12" id="recorded"  style="display:none">
              <h2>Recorded  Video</h2>
              <video id="recording" style="width:100%;" controls class="p-1 border"></video><br/><br/>
              <a id="downloadButton" class="btn btn-primary" data-url="{{route('beautician.videos.store')}}">save</a>
              <a id="downloadLocalButton" class="btn btn-primary">Download</a>
          </div>
      </div>
      <meta name="csrf-token" content="{{csrf_token()}}">
      <!-- <div class="modal-footer">
        <label class="lawwa-btn">
              <input type="radio" name="options" value="2" autocomplete="off"> Back Camera
        </label>
        <label class="lawwa-btn active">
              <input type="radio" name="options" value="1" autocomplete="off" checked> Front Camera
        </label>
      </div> -->
    </div>
  </div>
</div>
@endsection
@section('js')
<script>
    let preview = document.getElementById("preview");
    let recording = document.getElementById("recording");
    let startButton = document.getElementById("startButton");
    let stopButton = document.getElementById("stopButton");
    let downloadButton = document.getElementById("downloadButton");
    let logElement = document.getElementById("log");
    let recorded = document.getElementById("recorded");
    let downloadLocalButton = document.getElementById("downloadLocalButton");

    let recordingTimeMS = 5000; //video limit 5 sec
    var localstream;

    window.log = function (msg) {
    //logElement.innerHTML += msg + "\n";
    console.log(msg);
    }

    window.wait = function (delayInMS) {
    return new Promise(resolve => setTimeout(resolve, delayInMS));
    }

    window.startRecording = function (stream, lengthInMS) {
        let recorder = new MediaRecorder(stream);
        let data = [];

        recorder.ondataavailable = event => data.push(event.data);
        recorder.start();
        log(recorder.state + " for " + (lengthInMS / 1000) + " seconds...");

        let stopped = new Promise((resolve, reject) => {
            recorder.onstop = resolve;
            recorder.onerror = event => reject(event.name);
        });

        let recorded = wait(lengthInMS).then(
            () => recorder.state == "recording" && recorder.stop()
        );

        return Promise.all([
            stopped,
            recorded
            ])
        .then(() => data);
    }

    window.stop = function (stream) {
        stream.getTracks().forEach(track => track.stop());
    }
    var formData = new FormData();
    if (startButton) {
        startButton.addEventListener("click", function () {
            startButton.innerHTML = "recording...";
            recorded.style.display = "none";
            stopButton.style.display = "inline-block";
            downloadButton.innerHTML = "rendering..";
            navigator.mediaDevices.getUserMedia({
                video: true,
                audio: false
            }).then(stream => {
                preview.srcObject = stream;
                localstream = stream;
                //downloadButton.href = stream;
                preview.captureStream = preview.captureStream || preview.mozCaptureStream;
                return new Promise(resolve => preview.onplaying = resolve);
            }).then(() => startRecording(preview.captureStream(), recordingTimeMS))
            .then(recordedChunks => {
                let recordedBlob = new Blob(recordedChunks, {
                type: "video/webm"
                });
                recording.src = URL.createObjectURL(recordedBlob);

                formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
                formData.append('video', recordedBlob);
                formData.append('booking_id', "{{$Booking->id}}");

                downloadLocalButton.href = recording.src;
                downloadLocalButton.download = "RecordedVideo.webm";
                log("Successfully recorded " + recordedBlob.size + " bytes of " +
                recordedBlob.type + " media.");
                startButton.innerHTML = "Start";
                stopButton.style.display = "none";
                recorded.style.display = "block";
                downloadButton.innerHTML = "Save";
                localstream.getTracks()[0].stop();
            })
            .catch(log);
        }, false);
    }
    if (downloadButton) {
        downloadButton.addEventListener("click", function () {
            $.ajax({
            url: this.getAttribute('data-url'),
            method: 'POST',
            data: formData,
            beforeSend: function(){
             $("#downloadButton").html('<i class="fa fa-spinner fa-spin"></i>');
            },
            cache: false,
            processData: false,
            contentType: false,
            success: function (res) {
                if(res.success){
                  swal({
                    title: "Done!",
                    text: "video uploaded successfully!",
                    icon: "success",
                    button: "Ok!",
                    timer: 2000,
                  });
                  setTimeout(function () { location.reload(); }, 3000);
                }
            }
            });
        }, false);
    }
    if (stopButton) {
        stopButton.addEventListener("click", function () {
            stop(preview.srcObject);
            startButton.innerHTML = "Start";
            stopButton.style.display = "none";
            recorded.style.display = "block";
            downloadButton.innerHTML = "Save";
            localstream.getTracks()[0].stop();
        }, false);
    }
</script>
@endsection

