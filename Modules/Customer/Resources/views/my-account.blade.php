@extends('front::layouts.master')
@section('title') My-Account @endsection
@section('content')
<section class="my-account">
  <div class="container">
    <div class="row">
    @include('customer::includes.sidebar')
      <div class="col-md-9">
        <div class="right-content content">
          <div class="my-account-header">
<!--             <h6>My profile</h6>
 -->            <ul class="nav nav-tabs nav-pills nav-justified" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">My Profile</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="manage-address-tab" data-toggle="tab" href="#manage-address" role="tab" aria-controls="manage-address" aria-selected="false">Manage Address</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="change-password-tab" data-toggle="tab" href="#change-password" role="tab" aria-controls="change-password" aria-selected="false">Change Password</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="edit-profile-tab" data-toggle="tab" href="#edit-profile" role="tab" aria-controls="edit-profile" aria-selected="false">Edit Profile</a>
              </li>
            </ul>
          </div>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
              <div class="right-content-bottom">
                <div class="profile-block style-two">
                  <div class="profile-img">
                    <div class="img-block">
                        <img src="{{ asset('public/images/profilepics/'.Auth::user()->profile_pic) }}" class="profile_pic_image" onerror="this.src='/images/usericon.png'"  alt="Profile">
                    </div>
                    <!-- <label for="img_file_upid" class="file-btn">
                      <span><i class="fa fa-camera" aria-hidden="true"></i></span>
                      <input name="file_img" id="img_file_upid" type="file" required="">
                    </label> -->
                  </div>
                  <div class="profile-info">
                    <h6>{{{ isset(Auth::user()->full_name) ? Auth::user()->full_name : 'Guest' }}}</h6>
                    <span>{{{ isset(Auth::user()->email) ? Auth::user()->email : "" }}}</span>
                  </div>
                </div>
                <div class="personal-form">
                  <form>
                    <div class="form-title">
                      <h3>Personal Information</h3>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="first-name">Full Name</label>
                          <input type="text" name="Full Name" value="{{{ isset(Auth::user()->full_name) ? Auth::user()->full_name : 'Guest' }}}" id="first-name" placeholder="John" class="form-control" readonly="">
                        </div>
                      </div>
                      
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="email">Email Id</label>
                          <input type="text" name="email" value="{{{ isset(Auth::user()->email) ? Auth::user()->email : '' }}}" id="email" placeholder="johnwhite@gmail.com" class="form-control" readonly=""> 
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="mobile">Mobile Number </label>
                          <input type="text" name="mobile" value="{{{ isset(Auth::user()->phone_no) ? Auth::user()->phone_no : '' }}}"  id="mobile" placeholder="Mobile Number" class="form-control" readonly="">
                        </div>
                      </div>
                       <div class="col-md-12">
                        <div class="form-group">
                          <label>Gender</label>
                        @if(Auth::user()->UserProfileInformation!="")
                          @if(Auth::user()->UserProfileInformation->Gender=="")
                          <!-- <label class="form-check" for="male">
                            <input class="form-check-input" id="male" type="radio" disabled="" name="exampleRadios" value="option1" readonly="" >
                            <span class="radio-check">
                              <div class="radio-content">
                                <div class="img-block">
                                  <img src="{{ asset('front/assets/images/icons/male-gender.svg') }}" class="defalut-img" alt="Gender Icon">
                                  <img src="{{ asset('front/assets/images/icons/male-gender-hover.svg') }}" class="active-img" alt="Gender Icon">
                                </div>
                                <h6>Male</h6>
                              </div>
                            </span>
                          </label> -->
                           <label class="form-check" for="female">
                            <input class="form-check-input" id="female" disabled="" type="radio" name="exampleRadios" value="option2" readonly="">
                            <span class="radio-check">
                              <div class="radio-content">
                                <div class="img-block">
                                  <img src="{{ asset('front/assets/images/icons/female-gender.svg') }}" class="defalut-img" alt="Gender Icon">
                                  <img src="{{ asset('front/assets/images/icons/female-gender-hover.svg') }}" class="active-img" alt="Gender Icon">
                                </div>
                                <h6>Female</h6>
                              </div>
                            </span>
                          </label>
                          @else
                          <!-- <label class="form-check" for="male">
                            <input class="form-check-input" id="male" type="radio" name="exampleRadios" disabled="" value="option1" readonly="" {{  (Auth::user()->UserProfileInformation->Gender == 'Male' ? ' checked' : '') }} >
                            <span class="radio-check">
                              <div class="radio-content">
                                <div class="img-block">
                                  <img src="{{ asset('front/assets/images/icons/male-gender.svg') }}" class="defalut-img" alt="Gender Icon">
                                  <img src="{{ asset('front/assets/images/icons/male-gender-hover.svg') }}" class="active-img" alt="Gender Icon">
                                </div>
                                <h6>Male</h6>
                              </div>
                            </span>
                          </label> -->
                          <label class="form-check" for="female">
                            <input class="form-check-input" id="female" type="radio" disabled="" name="exampleRadios" readonly="" value="option2" {{  (Auth::user()->UserProfileInformation->Gender == 'Female' ? ' checked' : '') }}  >
                            <span class="radio-check">
                              <div class="radio-content">
                                <div class="img-block">
                                  <img src="{{ asset('front/assets/images/icons/female-gender.svg') }}" class="defalut-img" alt="Gender Icon">
                                  <img src="{{ asset('front/assets/images/icons/female-gender-hover.svg') }}" class="active-img" alt="Gender Icon">
                                </div>
                                <h6>Female</h6>
                              </div>
                            </span>
                          </label>
                          @endif
                          @else
                           <!-- <label class="form-check" for="male">
                            <input class="form-check-input" id="male" type="radio" name="exampleRadios" value="option1" disabled="" readonly="" >
                            <span class="radio-check">
                              <div class="radio-content">
                                <div class="img-block">
                                  <img src="{{ asset('front/assets/images/icons/male-gender.svg') }}" class="defalut-img" alt="Gender Icon">
                                  <img src="{{ asset('front/assets/images/icons/male-gender-hover.svg') }}" class="active-img" alt="Gender Icon">
                                </div>
                                <h6>Male</h6>
                              </div>
                            </span>
                          </label> -->
                           <label class="form-check" for="female">
                            <input class="form-check-input" id="female" type="radio" name="exampleRadios" value="option2" disabled="" readonly="">
                            <span class="radio-check">
                              <div class="radio-content">
                                <div class="img-block">
                                  <img src="{{ asset('front/assets/images/icons/female-gender.svg') }}" class="defalut-img" alt="Gender Icon">
                                  <img src="{{ asset('front/assets/images/icons/female-gender-hover.svg') }}" class="active-img" alt="Gender Icon">
                                </div>
                                <h6>Female</h6>
                              </div>
                            </span>
                          </label>
                        @endif
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Address 
                            <!-- <div class="float-right">
                              <a href="#0" class="link">Edit</a>
                              <a href="#0" class="link ml-3">Delete</a>
                            </div> -->
                          </label>
                          <div class="fixed-textarea">
                            <textarea class="form-control" placeholder="{{{ isset(Auth::user()->Address_Location) ? Auth::user()->Address_Location : '' }}}" readonly="">{{{ isset(Auth::user()->Address_Location) ? Auth::user()->Address_Location : '' }}}</textarea>
                            <!-- <span class="add-edit-type">Home</span> -->
                          </div>
                        </div>
                      </div>
                     <!--  <div class="btn-block col-md-12">
                        <button type="submit" class="lawwa-btn">Save</button>
                      </div> -->
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="tab-pane fade " id="manage-address" role="tabpanel" aria-labelledby="manage-address-tab">
              <div class="right-content-bottom">
                <div class="manage-form">
                  <form method="post" id="address_form">
                    <span id="form_output"></span>
                    @csrf
                    <div class="form-title">
                      <h3>Manage Addresses</h3>
                      <a href="#"  class="float-right link" id="new-address-add">Add New Address</a>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Address 
          
                          </label>
                          <div id="addressess">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="new-address-add" style="display: none;">
                      <div class="form-title">
                        <h3 class="address-title">Add New Address</h3>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="Name">Name</label>
                            <input type="text" name="Name" id="Name" placeholder="Name.." class="form-control">
                          </div>
                        </div>
                        <input type="text"  name="address_id" id="address_id" hidden="" value="null">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="mobile-no">Mobile No</label>
                            <input type="number" name="MobileNumber" maxlength="12" minlength="7"  id="MobileNumber" placeholder="Enter mobile number" class="form-control">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="city">Country</label>
                            <select class="form-control" name="Country" id="country-dropdown">
                              @foreach ($countries as $country) 
                                <option value="{{$country->id}}">{{$country->name}}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="state">State</label>
                            <select class="form-control" name="State_Province_Region" id="state-dropdown">
                              
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="country">City</label>
                            <select class="form-control" name="Town_City" id="city-dropdown">
                              
                            </select>
                          </div>
                        </div> 
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="Postcode">Postcode</label>
                            <input type="text" name="Zip_Postcode" minlength="5" maxlength="5" id="Zip_Postcode" placeholder="Postcode" class="form-control">
                          </div>
                        </div> 
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="address">Address</label>
                            <textarea id="Address_line1" name="Address_line1" placeholder="Address" class="form-control"></textarea>
                          </div>
                        </div> 
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Address Type</label>
                            <label class="form-check" for="home">
                              <input class="form-check-input" id="home" type="radio" name="Type" value="Home">
                              <span class="radio-check">
                                <div class="radio-content">
                                  <div class="img-block">
                                    <img src="{{ asset('front/assets/images/icons/home-icon.svg') }}" class="defalut-img" alt="Home Icon">
                                    <img src="{{ asset('front/assets/images/icons/home-icon-hover.svg') }}" class="active-img" alt="Home Icon">
                                  </div>
                                  <h6>Default</h6>
                                </div>
                              </span>
                            </label>
                            <label class="form-check" for="work">
                              <input class="form-check-input" id="work" type="radio" name="Type" value="Work">
                              <span class="radio-check">
                                <div class="radio-content">
                                  <div class="img-block">
                                    <img src="{{ asset('front/assets/images/icons/work-icon.svg') }}" class="defalut-img" alt="Work Icon">
                                    <img src="{{ asset('front/assets/images/icons/work-icon-hover.svg') }}" class="active-img" alt="Work Icon">
                                  </div>
                                  <h6>Work</h6>
                                </div>
                              </span>
                            </label>
                            <label class="form-check" for="other">
                              <input class="form-check-input" id="other" type="radio" name="Type" value="Other">
                              <span class="radio-check">
                                <div class="radio-content">
                                  <div class="img-block">
                                    <img src="{{ asset('front/assets/images/icons/other-icon.svg') }}" class="defalut-img" alt="other Icon">
                                    <img src="{{ asset('front/assets/images/icons/other-icon-hover.svg') }}" class="active-img" alt="other Icon">
                                  </div>
                                  <h6>Other</h6>
                                </div>
                              </span>
                            </label>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="btn-block">
                            <input type="submit" name="submit" id="saveaddress" value="Add" class="lawwa-btn" />
                            <input type="reset"  value="Reset" id="resetaddress" class="lawwa-btn" />
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="change-password" role="tabpanel" aria-labelledby="change-password-tab">
              <div class="right-content-bottom">
                <div class="change-password">
                  <div class="form-title">
                    <h3>Change Password</h3>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                  <form action="{{route('customer.ChangePassword')}}" method="post" id="changepassword" >
                    <span id="change_output"></span>
                    @csrf
                      <div class="form-group">
                        <label for="current-password">Old Password</label>
                        <input type="password" id="current-password" name="current-password" class="form-control" placeholder="Old Password">
                      </div>
                      <div class="form-group">
                        <label for="new-password">New Password</label>
                        <input type="password" id="new-password" name="new-password" class="form-control" placeholder="New Password">
                      </div>
                      <div class="form-group">
                        <label for="new-password_confirmation">Confirm Password</label>
                        <input type="password" id="new-password_confirmation" name="new-password_confirmation" class="form-control" placeholder="Confirm Password">
                      </div>
                    </div>
          
                    <div class="col-md-12">
                      <div class="btn-block">
                        <input type="submit" name="submit"  value="Save" class="lawwa-btn lawwa-pink-btn" />
                        <input type="reset" name="submit"  value="Reset" class="lawwa-btn lawwa-pink-btn" />
                      </div>
                    </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="edit-profile" role="tabpanel" aria-labelledby="edit-profile-tab">
              <div class="right-content-bottom">
                <div class="profile-block">
                  <div class="profile-img">
                  <form method="post" action="{{route('customer.UpdateProfilePic')}}" id="upload_image_form"  enctype="multipart/form-data"  >
                    @csrf
                  <label for="profile-img">
                    <div class="img-block">
                        <img src="{{ asset('public/images/profilepics/'.Auth::user()->profile_pic) }}" onerror="this.src='/images/usericon.png'" class="profile_pic_image" alt="Profile">
                    </div>
                      <input type="file" name="profile_pic" class="file" id="profile-img" style="display: none;">
                      <span class="file-camera"><i class="fa fa-camera" aria-hidden="true"></i></span>
                    </label>                    
                   
                    </form>
                   </div>
                 <div class="profile-info">
                    <h6>{{{ isset(Auth::user()->full_name) ? Auth::user()->full_name : 'Guest' }}}</h6>
                    <span>{{{ isset(Auth::user()->email) ? Auth::user()->email : "" }}}</span>
                  </div>
                </div>
                <div class="personal-form">
                  <form method="post" id="update_information">
                  <span id="update_information_status"></span>
                    @csrf
                    <div class="form-title">
                      <h3>Personal Information</h3>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="Full Name" class="asterisk"> Full Name</label>
                          <input type="text" name="full_name" value="{{{ isset(Auth::user()->full_name) ? Auth::user()->full_name : 'Guest' }}}" id="Full Name" placeholder="Enter full name" class="form-control" >
                        </div>
                      </div>
                      
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="email">Email Id <!-- <a href="#0" class="float-right link">Change?</a> --></label>
                          <input type="text" name="email" readonly="" value="{{{ isset(Auth::user()->email) ? Auth::user()->email : '' }}}" id="email" placeholder="Enter email" class="form-control"> 
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="phone_no" class="asterisk"> Mobile Number </label>
                          <input type="text" name="phone_no" value="{{{ isset(Auth::user()->phone_no) ? Auth::user()->phone_no : '' }}}"  id="phone_no" placeholder="Enter mobile number "  class="form-control">
                        </div>
                      </div>
                     <div class="col-md-12">
                          <div class="form-group">
                         <label class="asterisk">Gender</label>
                            {{--<label class="form-check" for="Male">
                              <input class="form-check-input" id="Male" type="radio" name="Gender" value="Male" @isset(Auth::user()->UserProfileInformation->Gender) @if(Auth::user()->UserProfileInformation->Gender=="Male") checked @endif  @endisset>
                              <span class="radio-check">
                                <div class="radio-content">
                                  <div class="img-block">
                                    <img src="{{ asset('front/assets/images/icons/male-gender.svg') }}" class="defalut-img" alt="Gender Icon">
                                  <img src="{{ asset('front/assets/images/icons/male-gender-hover.svg') }}" class="active-img" alt="Gender Icon">
                                  </div>
                                  <h6>Male</h6>
                                </div>
                              </span>
                            </label>--}}
                            <label class="form-check" for="Female">
                              <input class="form-check-input" id="Female" type="radio" name="Gender" value="Female" @isset(Auth::user()->UserProfileInformation->Gender) @if(Auth::user()->UserProfileInformation->Gender=="Female") checked @endif  @endisset >
                              <span class="radio-check">
                                <div class="radio-content">
                                  <div class="img-block">
                                     <img src="{{ asset('front/assets/images/icons/female-gender.svg') }}" class="defalut-img" alt="Gender Icon">
                                  <img src="{{ asset('front/assets/images/icons/female-gender-hover.svg') }}" class="active-img" alt="Gender Icon">
                                  </div>
                                  <h6>Female</h6>
                                </div>
                              </span>
                            </label>
                          
                          </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="asterisk"> Address 
                            <!-- <div class="float-right">
                              <a href="#0" class="link">Edit</a>
                              <a href="#0" class="link ml-3">Delete</a>
                            </div> -->
                          </label>
                          <div class="fixed-textarea">
                            <textarea class="form-control"  name="Address_Location" value="{{{ isset(Auth::user()->Address_Location) ? Auth::user()->Address_Location : '' }}}" placeholder="Address">{{{ isset(Auth::user()->Address_Location) ? Auth::user()->Address_Location : '' }}}</textarea>
                             <!-- <span class="add-edit-type">Default</span> -->
                          </div>
                        </div>
                      </div>
                      <div class="btn-block col-md-12">
                        <input type="submit" name="submit" id="saveprofile" value="Save" class="lawwa-btn" />
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

@section('js')
@include('front::externaljs.city-country-statejs')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript">
  $('#profile-img').change(function(){
      $('form').submit(function(evt){
          let timerInterval='<img src="{{ asset('images/lawwaloder.gif' ) }}">';
          Swal.fire({
            html: timerInterval,
            didOpen: () => {
              Swal.showLoading()
            },
            willClose: () => {
              clearInterval(timerInterval)
            }
          }).then((result) => {
            /* Read more about handling dismissals below */
            if (result.dismiss === Swal.DismissReason.timer) {
              console.log('I was closed by the timer')
            }
          })
          evt.preventDefault();
      });
    $('#upload_image_form').submit();
  });
  $('#upload_image_form').submit(function(e) {
    event.preventDefault();
    var formData = new FormData(this);
    $.ajax({
      url:"{{ route('customer.UpdateProfilePic') }}",
      type: 'POST',  
      data:formData,
      cache:false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(data){
        if(data.error.length > 0){
          Swal.fire({
            position: 'top-center',
            title: "Warning!",
            text: "Profile pic not update",
            icon: "warning",
            button: "Ok!",
            timer: 2000,
          });
        }
        else{
          var url = '{{ URL::asset("public/images/profilepics/") }}';
          var imageurl=url + '/' + data.imageName;
          $(".profile_pic_image").attr('src',imageurl);
          Swal.fire({
            title: "Success!",
            text: data.success,
            icon: "success",
            button: "Ok!",
            timer: 2000,
          });
        }
      }
    })
  });
</script>
<script type="text/javascript">
  $(function() {
    $("#changepassword").validate({
      rules: {
        "current-password": {
          required: true,
        },
        "new-password": {
          required: true,
          minlength : 6,
        },
        "new-password_confirmation": {
          required: true,
          minlength : 6,
          equalTo : "#new-password"
        },
      },
    });
  });
</script>
<script type="text/javascript">
  $('#changepassword').on('submit', function(event){
    event.preventDefault();  
    var form_data = $(this).serialize();
    $.ajax({
      url:"{{ route('customer.ChangePassword') }}",
      method:"POST",
      data:form_data,
      dataType:"json",
      success:function(data){
        if(data.error.length > 0){
          var error_html = '';
          for(var count = 0; count < data.error.length; count++){
            error_html += '<div class="alert alert-danger">'+data.error[count]+'</div>';
          }
          Swal.fire({
            html: error_html,  
            timer: 5000,
            icon: "error",
            button: "Ok!",
          });
        }
        else{
          $('#changepassword').trigger("reset");
          Swal.fire({
            html: data.success,  
            timer: 5000,
            button: "Ok!",
          });
        }
      }
    })
  });
</script>
<script type="text/javascript">
  onkeyup: $(function() {
    $("#update_information").validate({
      onkeyup: true, 
      rules: {
        full_name: {
          required: true,
        },
        email: {
          required: true,
          email: true
        },
        Address_Location: {
          required: true,
        },
        phone_no: {
          required: true,
          digits: true,
          minlength: 7,
          maxlength: 12,
        }
      },
      messages: {
      full_name: {
      required: "Please enter full name",
     },           
     phone_no: {
      required: "Please enter phone number",
      digits: "Please enter valid phone number",
      minlength: "Phone number field accept only 7 digits",
      maxlength: "Phone number field accept only 12 digits",
     },     
     email: {
      required: "Please enter email address",
      email: "Please enter a valid email address.",
     },
    },
    });
  });
</script>
<script type="text/javascript">
  $(function() {
    ignore: [],
    $("#address_form").validate({
      rules: {
        'Name': {
          required: true,
        },
        'MobileNumber': {
          required: true,
          digits: true
        },
        'Country': {
          required: true,
        },
        'State_Province_Region': {
          required: true,
        } ,
        'Town_City': {
          required: true,
        },
        'Zip_Postcode': {
          required: true,
          digits: true
        } ,
        'Address_line1': {
          required: true,
        } ,
        'Type': {
          required: true,
        }     
      },
    });
  });
</script>
<script>
  $(document).on('click','#new-address-add',function(){
     $("label.error").hide();
     $(".error").removeClass("error");
     $(".new-address-add").css("display", "block");
     $(".address-title").text("Add New Address");
     $('#address_id').val("null");
     $('#address_form')[0].reset();
     $('#state-dropdown').val(false);
    // $('#country-dropdown').val(false);
     $('#city-dropdown').val(false);

  });
</script>
<script>
  $(document).ready(function(){
    $(document).on('click','.edit-address',function(){
      $("label.error").hide();
      $(".error").removeClass("error");
      $(".address-title").text("Edit-Address");
      $(".new-address-add").css("display", "block");
      // $(".new-address-add").toggle();
      $('#MobileNumber').val($(this).data("mobilenumber"));
      $('#Name').val($(this).data("name"));
      $('#Zip_Postcode').val( $(this).data("zip_postcode"));
      $('#Address_line1').val( $(this).data("address_line1"));
      $('#address_id').val( $(this).data("address_id"));
      $('#country-dropdown').val($(this).data("country"));
        var state_id =($(this).data("state_province_region"));
        var city_id =($(this).data("town_city"));
        var country_id = $(this).data("country"); 
        var address_id = $(this).data("address_id"); 
        var type= $(this).data("type")       
        if (type=='Home') {
          $('#home').prop('checked',true)
        }
        else if(type=='Work'){
          $('#work').prop('checked',true)
        }
        else{
          $('#other').prop('checked',true)
        }
        $("#state-dropdown").html('');
          $.ajax({
            url:"{{url('get-states-by-country')}}",
            type: "POST",
            data: {
              country_id: country_id,
              _token: '{{csrf_token()}}' 
            },
            dataType : 'json',               
            success: function(result){
              $('#state-dropdown').html('<option value="" >Select State</option>');
              $.each(result.states,function(key,value){
                if (state_id==value.id) {
                  $("#state-dropdown").append('<option selected value="'+value.id+'">'+value.name+'</option>');
                }
                else{
                  $("#state-dropdown").append('<option value="'+value.id+'">'+value.name+'</option>');
                }
              });
              $("#city-dropdown").html('');
              $.ajax({
                url:"{{url('get-cities-by-state')}}",
                type: "POST",
                  data: {
                    state_id: state_id,
                    _token: '{{csrf_token()}}' 
                  },
                  dataType : 'json',
                  success: function(result){
                    $('#city-dropdown').html('<option value="">Select City</option>'); 
                    $.each(result.cities,function(key,city){
                      if (city_id==city.id) {
                        $("#city-dropdown").append('<option selected value="'+city.id+'">'+city.name+'</option>');
                      }
                      else{
                        $("#city-dropdown").append('<option  value="'+city.id+'">'+city.name+'</option>');
                      }
                  }); 
                }
              });
            $('#city-dropdown').html('<option value="" >Select State First</option>'); 
          }
        });
    });
  });
</script>
<script type="text/javascript">
    $('#update_information').on('submit', function(event){
        event.preventDefault();  
        var form_data = $(this).serialize();
        $.ajax({
            url:"{{ route('customer.UpdateProfileInformation') }}",
            method:"POST",
            data:form_data,
            dataType:"json",
            success:function(data)
            {
              if(data.error.length > 0){
                  var error_html = '';
                  for(var count = 0; count < data.error.length; count++){
                      error_html += '<div class="alert alert-danger">'+data.error[count]+'</div>';
                  }
                  $('#update_information_status').html(error_html);
              }
              else{
                  $('#update_information_status').html(data.success);
                  Swal.fire({
                      title: "Success!",
                      text: data.success,
                      icon: "success",
                      button: "Ok!",
                      timer: 2000,
                    }); 
                }
            }
        })
    });
</script>
<script>
    function reload_address() {
      $.ajax({
        url:"{{ route('customer.GetAddress') }}",
        type: 'get', //this is your method
        dataType: 'json',
        success: function(response){
        $('#addressess').html(response);
        }
      });
    }
    reload_address();
</script>
<script type="text/javascript">
    $('#address_form').on('submit', function(event){
        event.preventDefault();  
        var form_data = $(this).serialize();
        $.ajax({
            url:"{{ route('customer.AddAddress') }}",
            method:"POST",
            data:form_data,
            dataType:"json",
            success:function(data)
            {
              if(data.error.length > 0){
                  var error_html = '';
                  for(var count = 0; count < data.error.length; count++){
                      error_html += '<div class="alert alert-danger">'+data.error[count]+'</div>';
                  }
                  Swal.fire({
                      title: "Warning!",
                      text: "Please fill the required fields",
                      icon: "warning",
                      button: "Ok!",
                      timer: 2000,
                  });
              }
              else{
                   Swal.fire({
                      title: "Success!",
                      text: data.success,
                      icon: "success",
                      button: "Ok!",
                      timer: 2000,
                    }); 
                  // $('#form_output').html(data.success);
                  $('#address_form')[0].reset();
                    $(".new-address-add").css("display", "none");
                    reload_address();
                }
            }
        })
    });
</script>
<script>
  $(document).ready(function(){

    $(document).on('click','.delete-address',function(){
       let id = $(this).data('id');
        var notifictionid= $(this).attr("id");
        let model = $(this).data('model');
        let status = $(this).data('status');
       Swal.fire({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary!",
            icon: "warning",
            showCancelButton: true,
            buttons: true,
            dangerMode: true,
        })
  .then((result) => {
      if (result.value) {
          $.ajax({
            type: "POST",
            dataType: "json",
            url: '{{ route('universaldelete') }}',
            data: {'id': id,'model':model,'status':status,"_token": "{{ csrf_token() }}"},
            success: function (data) {
              if(data.status=='ok')
              { 
                reload_address();
                $(".new-address-add").css("display", "none");
                $('#address_form')[0].reset();     
               Swal.fire({
                      title: "Success!",
                      text: data.message,
                      icon: "success",
                      button: "Ok!",
                      timer: 2000,
                    });    
              }
              if(data.status=='error')
              {
              alert(data.message);    
              }
      
            },
        });
         } 
       });
    });
});
</script>
@endsection