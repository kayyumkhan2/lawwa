@extends('front::layouts.master')
@section('title') Health Conditions @endsection
@section('content')
<section class="my-order">
  <div class="container">
    <div class="row">
        @include('customer::includes.sidebar')
        <div class="col-lg-9">
            <div class="right-content content">
              <div class="right-header">
                <div class="row align-items-center">
                  <div class="col-sm-12">
                    <h6>CUSTOMER HEALTH CONDITIONS FORM</h6>
                  </div>
                </div>
              </div>
              <div class ="ticket-right-content">
                <div class="container">
                    <div class="customer-details form-main-inner">
                      <h5 class="heading-small">Customer Details:</h5>
                      <form action="{{route('customer.health.condition.store')}}" name="healthconditions" enctype="multipart/form-data" method="post">
                      <div class="form-row">
                        <div class="form-groups col-md-6">
                          <label class="main-label">Name type</label> 
                          <select name="Name_type" class="form-control">
                            <option value="Mr" >Mr.</option>
                            <option value="Mrs" >Mrs.</option>
                            <option value="Datin" >Datin</option>
                          </select>
                        </div>
                        <div class="form-groups col-md-6">
                          <label class="main-label">Name </label> 
                          <input type="text" class="form-control" name="Name" value="{{ ($data) ? $data->Name : '' }}">
                        </div>
                        <div class="form-group col-md-12">
                          <label class="control-label" for="Address">Address</label>
                          <textarea class="form-control" id="Address" name="Address" cols="20" rows="5">{{ ($data) ? $data->Address : '' }}</textarea>
                        </div>
                      </div>

                      <div class="form-row">
                        <div class="form-groups col-md-6">
                          <label class="main-label">H/P No:</label> 
                          <input type="text" name="H_p_no"  value="{{ ($data) ? $data->Name : '' }}" class="form-control">
                        </div>
                        <div class="form-groups col-md-6">
                          <label class="main-label">Birth date:</label> 
                          <input type="date" name="Dob" value="{{ ($data) ? $data->Dob : '' }}" class="form-control">
                        </div>
                      </div>

                      <div class="form-row redio-btn">
                        <div class="form-groups col-md-3">
                         <label class="main-label">Marital status:</label>
                        </div>
                        <div class="form-groups col-md-3">
                            <ul class="payments_li">
                              <li>
                                <label class="custom_radios"> Married
                                  <input type="radio" name="Marital_status" value="Married" @if(!$data==""){{ $data->Marital_status == "Married" ? 'checked' : '' }} @endif>
                                  <small class="checkmark_rad"></small>
                                </label>
                              </li>
                            </ul>
                        </div>
                        <div class="form-groups col-md-3">
                            <ul class="payments_li">
                              <li>
                                <label class="custom_radios"> Single
                                  <input type="radio" name="Marital_status" value="Single" @if(!$data=="") {{ $data->Marital_status == "Single" ? 'checked' : '' }} @endif>
                                  <small class="checkmark_rad"></small>
                                </label>
                              </li>
                            </ul>
                        </div>
                        <div class="form-groups col-md-3">
                          <ul class="payments_li">
                            <li>
                              <label class="custom_radios"> Others
                                <input type="radio" name="Marital_status" value="{{ ($data) ? $data->Marital_status : '' }}" value="Others">
                                <small class="checkmark_rad"></small>
                              </label>
                            </li>
                          </ul>
                        </div>
                      </div>

                      <div class="form-row">
                        <div class="form-groups col-md-6">
                          <label class="main-label">Occupation:</label> 
                          <input type="text" name="Occupation" value="{{ ($data) ? $data->Occupation : '' }}" class="form-control">
                        </div>
                        <div class="form-groups col-md-6">
                          <label class="main-label">In case of emergency, please contact:</label> 
                          <input type="text" name="Emergency_number" value="{{ ($data) ? $data->Emergency_number : '' }}" class="form-control">
                        </div>
                      </div>

                      <h5>Lifestyle & Medical Information:</h5>
                      <div class="form-row redio-btn">
                        <div class="form-groups col-md-6">
                         <label>1) Plastic Surgery (Face):</label>
                        </div>
                        <div class="form-groups col-md-3">
                          <ul class="payments_li">
                            <li>
                              <label class="custom_radios"> Yes
                                <input type="radio" name="Plastic_Surgery_Face" value="Yes" @if(!$data=="")  {{ $data->Plastic_Surgery_Face == "Yes" ? 'checked' : '' }} @endif>
                                <small class="checkmark_rad"></small>
                              </label>
                            </li>
                          </ul>
                        </div>
                        <div class="form-groups col-md-3">
                          <ul class="payments_li">
                            <li>
                              <label class="custom_radios"> No
                                <input type="radio" name="Plastic_Surgery_Face" value="No" @if(!$data=="")  {{ $data->Plastic_Surgery_Face == "No" ? 'checked' : '' }} @endif>
                                <small class="checkmark_rad"></small>
                              </label>
                            </li>
                          </ul>
                        </div>
                      </div>

                      <div class="form-row">
                        <div class="form-groups col-md-6">
                         <label>Date:</label>
                         <input type="date" name="Plastic_Surgery_Date_Face"   value="{{ ($data) ? $data->Plastic_Surgery_Date_Face : '' }}"  class="form-control">
                        </div>
                        <div class="form-groups col-md-6">
                         <label>Type:</label>
                         <input type="text" name="Plastic_Surgery_Type_Face"  value="{{ ($data) ? $data->Plastic_Surgery_Type_Face : '' }}" class="form-control">
                        </div>
                      </div>

                      <div class="form-row redio-btn">
                        <div class="form-groups col-md-6">
                         <label>2) Surgery (Body):</label>
                        </div>
                        <div class="form-groups col-md-3">
                          <ul class="payments_li">
                            <li>
                              <label class="custom_radios"> Yes
                                <input type="radio" name="Plastic_Surgery_Body" value="Yes" @if(!$data=="") {{ $data->Plastic_Surgery_Body == "Yes" ? 'checked' : '' }} @endif>
                                <small class="checkmark_rad"></small>
                              </label>
                            </li>
                          </ul>
                        </div>
                        <div class="form-groups col-md-3">
                          <ul class="payments_li">
                            <li>
                              <label class="custom_radios"> No
                                <input type="radio" name="Plastic_Surgery_Body" value="No" @if(!$data=="") {{ $data->Plastic_Surgery_Body == "No" ? 'checked' : '' }} @endif> 
                                <small class="checkmark_rad"></small>
                              </label>
                            </li>
                          </ul>
                        </div>
                      </div>

                      <div class="form-row">
                        <div class="form-groups col-md-6">
                         <label>Date:</label>
                         <input type="date" name="Plastic_Surgery_Date_Body" class="form-control" value="{{ ($data) ? $data->Plastic_Surgery_Date_Body : '' }}">
                        </div>
                        <div class="form-groups col-md-6">
                         <label>Type:</label>
                         <input type="text" name="Plastic_Surgery_Type_Body" class="form-control" value="{{ ($data) ? $data->Plastic_Surgery_Type_Body : '' }}">
                        </div>
                      </div>

                      <div class="form-row redio-btn">
                        <div class="form-groups col-md-6">
                         <label>3) Pregnant:</label>
                        </div>
                        <div class="form-groups col-md-3">
                          <ul class="payments_li">
                            <li>
                              <label class="custom_radios"> Yes
                                <input type="radio" name="Pregnant" value="Yes"   @if(!$data=="") {{ $data->Pregnant == "Yes" ? 'checked' : '' }} @endif>
                                <small class="checkmark_rad"></small>
                              </label>
                            </li>
                          </ul>
                        </div>
                        <div class="form-groups col-md-3">
                           <ul class="payments_li">
                            <li>
                              <label class="custom_radios"> No
                                <input type="radio" name="Pregnant" value="No"   @if(!$data=="") {{ $data->Pregnant == "No" ? 'checked' : '' }} @endif>
                                <small class="checkmark_rad"></small>
                              </label>
                            </li>
                          </ul>
                        </div>
                      </div>

                      <div class="form-row">
                        <div class="form-groups col-md-12">
                          <label class="main-label">Pregnancy month:</label> 
                          <input type="date" name="Pregnancy_Month" class="form-control" value="{{ ($data) ? $data->Pregnancy_Month : '' }}">
                        </div>
                      </div>

                      <div class="form-row redio-btn">
                        <div class="form-groups col-md-6">
                         <label>4) Medications:</label>
                        </div>
                        <div class="form-groups col-md-3">
                          <ul class="payments_li">
                            <li>
                              <label class="custom_radios"> Yes
                                <input type="radio" name="Medications" value="Yes"   @if(!$data=="") {{ $data->Medications == "Yes" ? 'checked' : '' }} @endif>
                                <small class="checkmark_rad"></small>
                              </label>
                            </li>
                          </ul>
                        </div>
                        <div class="form-groups col-md-3">
                          <ul class="payments_li">
                            <li>
                              <label class="custom_radios"> No
                                <input type="radio" name="Medications" value="No"   @if(!$data=="") {{ $data->Medications == "No" ? 'checked' : '' }} @endif>
                                <small class="checkmark_rad"></small>
                              </label>
                            </li>
                          </ul>
                        </div>
                      </div>

                      <div class="form-row">
                        <div class="form-groups col-md-12">
                          <label class="main-label">Please specify:</label> 
                          <input type="text" name="Medications_Specify" class="form-control" value="{{ ($data) ? $data->Medications_Specify : '' }}">
                        </div>
                      </div>

                      <div class="form-row redio-btn">
                        <div class="form-groups col-md-6">
                         <label>5) Skin allergy (rash, hives, skin cancer, or other):</label>
                        </div>
                        <div class="form-groups col-md-3">
                          <ul class="payments_li">
                            <li>
                              <label class="custom_radios"> Yes
                                <input type="radio" name="Skin_Allergy" value="Yes"   @if(!$data=="") {{ $data->Skin_Allergy == "Yes" ? 'checked' : '' }} @endif>
                                <small class="checkmark_rad"></small>
                              </label>
                            </li>
                          </ul>
                        </div>
                        <div class="form-groups col-md-3">
                          <ul class="payments_li">
                            <li>
                              <label class="custom_radios"> No
                                <input type="radio" name="Skin_Allergy" value="No"   @if(!$data=="") {{ $data->Medications == "No" ? 'checked' : '' }} @endif>
                                <small class="checkmark_rad"></small>
                              </label>
                            </li>
                          </ul>
                        </div>
                      </div>

                      <div class="form-row">
                        <div class="form-groups col-md-12">
                          <label class="main-label">Please specify:</label> 
                          <input type="text" name="Skin_Allergy_Specify" class="form-control" value="{{ ($data) ? $data->Skin_Allergy_Specify : '' }}">
                        </div>
                      </div>

                      <div class="form-row">
                        <div class="form-groups col-md-12">
                          <label class="main-label">6) Skin type (oily, dry, combination, normal or other):</label> 
                        </div>
                        <div class="form-groups col-md-12">
                          <label class="main-label">Please specify:</label> 
                          <input type="text" name="Skin_Type_Specify" class="form-control" value="{{ ($data) ? $data->Skin_Type_Specify : '' }}">
                        </div>
                      </div>

                      <h5>Dermalysis:</h5>
                      <div class="form-row">
                        <div class="form-groups col-md-12">
                         <label>1) Service focus:</label>
                        </div>
                        <div class="form-groups col-md-4">
                          <ul class="payments_li">
                            <li>
                              @php if(!$data=="") { $Service_Focus =json_decode($data->Service_Focus,true); } else { $Service_Focus = array(); }  @endphp
                              <label class="custom_radios"> 1. Reduce Oiliness
                                <input type="radio" name="Service_Focus[]" @if(in_array('Reduce Oiliness', $Service_Focus)) checked="" @endif name="Reduce Oiliness" value="Reduce Oiliness">
                                <small class="checkmark_rad"></small>
                              </label>
                            </li>
                          </ul>
                        </div>
                        <div class="form-groups col-md-4">
                          <ul class="payments_li">
                            <li>
                              <label class="custom_radios"> 2. Firming
                                <input type="radio" name="Service_Focus[]" name="Firming" @if(in_array('Firming', $Service_Focus)) checked="" @endif value="Firming">
                                <small class="checkmark_rad"></small>
                              </label>
                            </li>
                          </ul>
                        </div>
                        <div class="form-groups col-md-4">
                          <ul class="payments_li">
                            <li>
                              <label class="custom_radios"> 3. Clear Acne
                                <input type="radio" name="Service_Focus[]"   @if(in_array('Clear Acne', $Service_Focus)) checked="" @endif name="Clear Acne" value="Clear Acne">
                                <small class="checkmark_rad"></small>
                              </label>
                            </li>
                          </ul>
                        </div>
                        <div class="form-groups col-md-4">
                          <ul class="payments_li">
                            <li>
                              <label class="custom_radios"> 4. Refine Pores
                                <input type="radio" name="Service_Focus[]" @if(in_array('Refine Pores', $Service_Focus)) checked="" @endif name="Refine Pores" value="Refine Pores">
                                <small class="checkmark_rad"></small>
                              </label>
                            </li>
                          </ul>
                        </div>
                        <div class="form-groups col-md-4">
                          <ul class="payments_li">
                            <li>
                              <label class="custom_radios"> 5. Clear blackhead
                                <input type="radio" name="Service_Focus[]"  @if(in_array('Clear blackhead', $Service_Focus)) checked="" @endif name="Clear blackhead" value="Clear blackhead">
                                <small class="checkmark_rad"></small>
                              </label>
                            </li>
                          </ul>
                        </div>
                        <div class="form-groups col-md-4">
                          <ul class="payments_li">
                            <li>
                              <label class="custom_radios"> 6. Reduce Sensitiveness
                                <input type="radio" name="Service_Focus[]" @if(in_array('Reduce Sensitiveness', $Service_Focus)) checked="" @endif name="Reduce Sensitiveness" value="Reduce Sensitiveness">
                                <small class="checkmark_rad"></small>
                              </label>
                            </li>
                          </ul>
                        </div>
                        <div class="form-groups col-md-4">
                          <ul class="payments_li">
                            <li>
                              <label class="custom_radios"> 7. Reduce Wrinkles
                                <input type="radio" name="Service_Focus[]" @if(in_array('Reduce Wrinkles', $Service_Focus)) checked="" @endif name="Reduce Wrinkles" value="Reduce Wrinkles">
                                <small class="checkmark_rad"></small>
                              </label>
                            </li>
                          </ul>
                        </div>
                        <div class="form-groups col-md-4">
                          <ul class="payments_li">
                            <li>
                              <label class="custom_radios"> 8. Repair & Healing
                                <input type="radio" name="Service_Focus[]" @if(in_array('Repair & Healings', $Service_Focus)) checked="" @endif name="Repair & Healing" value="Repair & Healing">
                                <small class="checkmark_rad"></small>
                              </label>
                            </li>
                          </ul>
                        </div>
                        <div class="form-groups col-md-4">
                          <ul class="payments_li">
                            <li>
                              <label class="custom_radios"> 9. Skin Lightening
                                <input type="radio" name="Service_Focus[]" @if(in_array('Skin Lightening', $Service_Focus)) checked="" @endif name="Skin Lightening" value="Skin Lightening">
                                <small class="checkmark_rad"></small>
                              </label>
                            </li>
                          </ul>
                        </div>
                        <div class="form-groups col-md-4">
                          <ul class="payments_li">
                            <li>
                              <label class="custom_radios"> 10. Lighten Acne Scar
                                <input type="radio" name="Service_Focus[]" @if(in_array('Lighten Acne Scar', $Service_Focus)) checked="" @endif name="Lighten Acne Scar" value="Lighten Acne Scar">
                                <small class="checkmark_rad"></small>
                              </label>
                            </li>
                          </ul>
                        </div>
                        <div class="form-groups col-md-4">
                          <ul class="payments_li">
                            <li>
                              <label class="custom_radios"> 11. Lighten Pigmentation
                                <input type="radio" name="Service_Focus[]" @if(in_array('Lighten Pigmentation', $Service_Focus)) checked="" @endif name="Lighten Pigmentation" value="Lighten Pigmentation">
                                <small class="checkmark_rad"></small>
                              </label>
                            </li>
                          </ul>
                        </div>
                      </div>

                      <div class="form-row">
                        <div class="form-groups col-md-12">
                          <label class="main-label">Remark:</label> 
                          <input type="text" name="Service_Focus_Remark" class="form-control" value="{{ ($data) ? $data->Service_Focus_Remark : '' }}">
                        </div>
                      </div>

                      <div class="form-row redio-btn">
                        <div class="form-groups col-md-6">
                         <label> 2) Last facial treatment: </label>
                        </div>
                        <div class="form-groups col-md-3">
                          <ul class="payments_li">
                            <li>
                              <label class="custom_radios"> Yes
                                <input type="radio" name="Last_Facial_Treatment"   @if(!$data=="") value="Yes" {{ $data->Last_Facial_Treatment == "Yes" ? 'checked' : '' }} @endif>
                                <small class="checkmark_rad"></small>
                              </label>
                            </li>
                          </ul>
                        </div>
                        <div class="form-groups col-md-3">
                          <ul class="payments_li">
                            <li>
                              <label class="custom_radios"> No
                                <input type="radio" name="Last_Facial_Treatment"   @if(!$data=="") value="No" {{ $data->Last_Facial_Treatment == "No" ? 'checked' : '' }} @endif>
                                <small class="checkmark_rad"></small>
                              </label>
                            </li>
                          </ul>
                        </div>
                      </div>

                        <div class="form-row">
                          <div class="form-groups col-md-4">
                            <label class="main-label">Date:</label> 
                            <input type="date" name="Last_Facial_Treatment_date" class="form-control" value="{{ ($data) ? $data->Last_Facial_Treatment_date : '' }}">
                          </div>
                          <div class="form-groups col-md-4">
                            <label class="main-label">Type:</label> 
                            <input type="text" name="Last_Facial_Treatment_Type" class="form-control" value="{{ ($data) ? $data->Last_Facial_Treatment_Type : '' }}">
                          </div>
                          <div class="form-groups col-md-4">
                            <label class="main-label">How often:</label> 
                            <input type="text" name="Last_Facial_Treatment_How_Often" class="form-control" value="{{ ($data) ? $data->Last_Facial_Treatment_How_Often : '' }}">
                          </div>
                        </div>

                      <div class="form-row redio-btn">
                        <div class="form-groups col-md-12">
                         <label>3) Skincare routine at home:</label>
                        </div>
                        <div class="form-groups col-md-4">
                          <ul class="payments_li">
                            <li>
                              <label class="custom_radios"> 1. Reduce Oiliness
                                <input type="radio" name="Skincare_Routine_At_Home" value="Reduce Oiliness" @if(!$data =="") {{ $data->Skincare_Routine_At_Home == "Reduce Oiliness" ? 'checked' : '' }} @endif>
                                <small class="checkmark_rad"></small>
                              </label>
                            </li>
                          </ul>
                        </div>
                        <div class="form-groups col-md-4">
                          <ul class="payments_li">
                            <li>
                              <label class="custom_radios"> 2. Scrub
                                <input type="radio" name="Skincare_Routine_At_Home" value="Scrub" @if(!$data =="") {{ $data->Skincare_Routine_At_Home == "Scrub" ? 'checked' : '' }} @endif>
                                <small class="checkmark_rad"></small>
                              </label>
                            </li>
                          </ul>
                        </div>
                        <div class="form-groups col-md-4">
                          <ul class="payments_li">
                            <li>
                              <label class="custom_radios"> 3. Toner
                                <input type="radio" name="Skincare_Routine_At_Home" value="Toner" @if(!$data =="") {{ $data->Skincare_Routine_At_Home == "Toner" ? 'checked' : '' }} @endif>
                                <small class="checkmark_rad"></small>
                              </label>
                            </li>
                          </ul>
                        </div>
                        <div class="form-groups col-md-4">
                          <ul class="payments_li">
                            <li>
                              <label class="custom_radios"> 4. Serum
                                <input type="radio" name="Skincare_Routine_At_Home" value="Serum" @if(!$data =="") {{ $data->Skincare_Routine_At_Home == "Serum" ? 'checked' : '' }} @endif>
                                <small class="checkmark_rad"></small>
                              </label>
                            </li>
                          </ul>
                        </div>
                        <div class="form-groups col-md-4">
                          <ul class="payments_li">
                            <li>
                              <label class="custom_radios"> 5. Sunblock
                                <input type="radio" name="Skincare_Routine_At_Home" value="Sunblock" @if(!$data =="") {{ $data->Skincare_Routine_At_Home == "Sunblock" ? 'checked' : '' }} @endif>
                                <small class="checkmark_rad"></small>
                              </label>
                            </li>
                          </ul>
                        </div>
                        <div class="form-groups col-md-4">
                          <ul class="payments_li">
                            <li>
                              <label class="custom_radios"> 6. Mask
                                <input type="radio" name="Skincare_Routine_At_Home" value="Mask" @if(!$data =="") {{ $data->Skincare_Routine_At_Home == "Mask" ? 'checked' : '' }} @endif>
                                <small class="checkmark_rad"></small>
                              </label>
                            </li>
                          </ul>
                        </div>
                      </div>
         
                      <div class="form-row">
                        <div class="form-groups col-md-12">
                          <ul class="payments_li otders">
                            <li>
                              <label class="custom_radios"> 7. Others
                                <input type="radio" name="Skincare_Routine_At_Home" value="Others" @if(!$data =="") {{ $data->Skincare_Routine_At_Home == "Others" ? 'checked' : '' }} @endif>
                                <small class="checkmark_rad"></small>
                              </label>
                            </li>
                          </ul>
                          <input type="text" class="form-control" name="Skincare_Routine_At_Specify" value="{{ ($data) ? $data->Skincare_Routine_At_Specify : '' }}">
                        </div>
                      </div>

                      <div class="form-row">
                        <div class="form-groups col-md-12">
                          <label class="main-label">4) Product brand use:</label> 
                          <input type="text" name="Product_Brand_Use" value="{{ ($data) ? $data->Product_Brand_Use : '' }}" class="form-control">
                        </div>
                      </div>
                      <h5>Body Conditions:</h5>
                      <div class="form-row redio-btn">
                        <div class="form-groups col-md-6">
                         <label> 1) Last body massage or treatment: </label>
                        </div>
                        <div class="form-groups col-md-3">
                          <ul class="payments_li">
                            <li>
                              <label class="custom_radios"> Yes
                                <input type="radio" name="Last_Body_Treatment"   @if(!$data=="") value="Yes" {{ $data->Last_Body_Treatment == "Yes" ? 'checked' : '' }} @endif>
                                <small class="checkmark_rad"></small>
                              </label>
                            </li>
                          </ul>
                        </div>
                        <div class="form-groups col-md-3">
                          <ul class="payments_li">
                            <li>
                              <label class="custom_radios"> No
                                <input type="radio" name="Last_Body_Treatment"   @if(!$data=="") value="No" {{ $data->Last_Body_Treatment == "No" ? 'checked' : '' }} @endif>
                                <small class="checkmark_rad"></small>
                              </label>
                            </li>
                          </ul>
                        </div>
                      </div>
                        <div class="form-row">
                        <div class="form-groups col-md-4">
                          <label class="main-label">Date:</label> 
                          <input type="date" name="Last_Body_Treatment_Date" class="form-control" value="{{ ($data) ? $data->Last_Body_Treatment_Date : '' }}">
                        </div>
                        <div class="form-groups col-md-4">
                          <label class="main-label">Type:</label> 
                          <input type="text" name="Last_Body_Treatment_Type" class="form-control" value="{{ ($data) ? $data->Last_Body_Treatment_Type : '' }}">
                        </div>
                        <div class="form-groups col-md-4">
                          <label class="main-label">How often:</label> 
                          <input type="text" name="Last_Body_Treatment_How_Often" class="form-control" value="{{ ($data) ? $data->Last_Body_Treatment_How_Often : '' }}">
                        </div>
                      </div>  

                      <div class="form-row redio-btn">
                        <div class="form-groups col-md-6">
                         <label>2) Allergic or sensitive to any oil (essential oil, nut oil, scents or other):</label>
                        </div>
                        <div class="form-groups col-md-3">
                          <ul class="payments_li">
                            <li>
                              <label class="custom_radios"> Yes
                                <input type="radio" name="Body_Allergy_Sensitive"  @if(!$data=="")  value="Yes" {{ $data->Body_Allergy_Sensitive == "Yes" ? 'checked' : '' }} @endif>
                                <small class="checkmark_rad"></small>
                              </label>
                            </li>
                          </ul>
                        </div>
                        <div class="form-groups col-md-3">
                          <ul class="payments_li">
                            <li>
                              <label class="custom_radios"> No
                                <input type="radio" name="Body_Allergy_Sensitive"  @if(!$data=="")  value="No" {{ $data->Body_Allergy_Sensitive == "No" ? 'checked' : '' }} @endif>
                                <small class="checkmark_rad"></small>
                              </label>
                            </li>
                          </ul>
                        </div>
                        <div class="form-groups col-md-12">
                          <label class="main-label">Please specify:</label> 
                          <input type="text" name="Body_Allergy_Sensitive_Specify" value="{{ ($data) ? $data->Body_Allergy_Sensitive_Specify : '' }}" class="form-control">
                        </div>
                      </div>

                      <div class="form-row redio-btn">
                        <div class="form-groups col-md-6">
                         <label>3) Joint condition (stiffness arthritis or other):</label>
                        </div>
                        <div class="form-groups col-md-3">
                          <ul class="payments_li">
                            <li>
                              <label class="custom_radios"> Yes
                                <input type="radio" name="Joint_Condition" @if(!$data=="")  value="Yes" {{ $data->Joint_Condition == "Yes" ? 'checked' : '' }} @endif>
                                <small class="checkmark_rad"></small>
                              </label>
                            </li>
                          </ul>
                        </div>
                        <div class="form-groups col-md-3">
                          <ul class="payments_li">
                            <li>
                              <label class="custom_radios"> No
                                <input type="radio" name="Joint_Condition" @if(!$data=="")  value="No" {{ $data->Joint_Condition == "No" ? 'checked' : '' }} @endif>
                                <small class="checkmark_rad"></small>
                              </label>
                            </li>
                          </ul>
                        </div>
                        <div class="form-groups col-md-12">
                          <label class="main-label">Please specify:</label> 
                          <input type="text" name="Joint_Condition_Specify" value="{{ ($data) ? $data->Joint_Condition_Specify : '' }}" class="form-control">
                        </div>
                      </div>

                      <div class="form-row redio-btn">
                        <div class="form-groups col-md-6">
                         <label>4) Bone condition (osteoporosis, fracture or other):</label>
                        </div>
                        <div class="form-groups col-md-3">
                          <ul class="payments_li">
                            <li>
                              <label class="custom_radios"> Yes
                                <input type="radio" name="Bone_Condition" @if(!$data=="")  value="Yes" {{ $data->Bone_Condition == "Yes" ? 'checked' : '' }} @endif>
                                <small class="checkmark_rad"></small>
                              </label>
                            </li>
                          </ul>
                        </div>
                        <div class="form-groups col-md-3">
                          <ul class="payments_li">
                            <li>
                              <label class="custom_radios"> No
                                <input type="radio" name="Bone_Condition" @if(!$data=="")  value="No" {{ $data->Bone_Condition == "No" ? 'checked' : '' }} @endif>
                                <small class="checkmark_rad"></small>
                              </label>
                            </li>
                          </ul>
                        </div>
                        <div class="form-groups col-md-12">
                          <label class="main-label">Please specify:</label> 
                          <input type="text" name="Bone_Condition_Specify" class="form-control">
                        </div>
                      </div>

                      <div class="form-row redio-btn">
                        <div class="form-groups col-md-6">
                         <label>5) Circulatory condition (high blood pressure, varicose veins, blood clots or other):</label>
                        </div>
                        <div class="form-groups col-md-3">
                          <ul class="payments_li">
                            <li>
                              <label class="custom_radios"> Yes
                                <input type="radio" name="Circulatory_Condition"  @if(!$data=="") value="Yes" {{ $data->Circulatory_Condition == "Yes" ? 'checked' : '' }} @endif>
                                <small class="checkmark_rad"></small>
                              </label>
                            </li>
                          </ul>
                        </div>
                        <div class="form-groups col-md-3">
                          <ul class="payments_li">
                            <li>
                              <label class="custom_radios"> No
                                <input type="radio" name="Circulatory_Condition" @if(!$data=="")  value="No" {{ $data->Circulatory_Condition == "No" ? 'checked' : '' }} @endif>
                                <small class="checkmark_rad"></small>
                              </label>
                            </li>
                          </ul>
                        </div>
                        <div class="form-groups col-md-12">
                          <label class="main-label">Please specify:</label> 
                          <input type="text" name="Circulatory_Condition_Specify" class="form-control" @if(!$data =="") {{ $data->Circulatory_Condition_Specify == "Yes" ? 'checked' : '' }} @endif>
                        </div>
                      </div>

                      <div class="form-row redio-btn">
                        <div class="form-groups col-md-6">
                         <label>6) Diabetes:</label>
                        </div>
                        <div class="form-groups col-md-3">
                          <ul class="payments_li">
                            <li>
                              <label class="custom_radios"> Yes
                                <input type="radio" name="Diabetes" @if(!$data=="")  value="Yes" {{ $data->Diabetes == "Yes" ? 'checked' : '' }} @endif>
                                <small class="checkmark_rad"></small>
                              </label>
                            </li>
                          </ul>
                        </div>
                        <div class="form-groups col-md-3">
                          <ul class="payments_li">
                            <li>
                              <label class="custom_radios"> No
                                <input type="radio" name="Diabetes" @if(!$data=="")  value="No" {{ $data->Diabetes == "No" ? 'checked' : '' }} @endif>
                                <small class="checkmark_rad"></small>
                              </label>
                            </li>
                          </ul>
                        </div>
                        <div class="form-groups col-md-12">
                          <label class="main-label">Please specify:</label> 
                          <input type="text" class="form-control" value="{{ ($data) ? $data->Diabetes_Specify : '' }}">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12">
                          <div class="checkalltext">
                            It is in my interests to disclose any allergy or extraordinary health conditions in this form. The 
                            Company shall not under any circumstances be imputed with any knowledge of my conditions 
                            not disclosed in this form. I understand that while the procedures adopted by the Company
                            are not expected to be life endangering, some individuals may experience some discomfort. I
                            am able to withstand such discomfort and I am accepting the course at my own risk.
                          </div>
                        </div>
                      </div>

                      <div class="form-row">
                        <div class="col-md-12">
                          <label class="main-label"> Customer Sign:</label>
                          <input type="file" name="Customer_Sign" class="form-control file">
                           @csrf
                        </div>
                      </div>
                      <div class="btn-block">
                        <button type="submit" class="lawwa-btn"> Save </button>
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
@endsection
@section('js')
<script type="text/javascript">
          $(function() {
            errorElement: 'div' ;
            $("form[name='healthconditions']").validate({
               errorPlacement: function(error, element) {
                  if (element.attr("type") == "radio") {
                      error.insertBefore(element);
                  } else {
                      error.insertAfter(element);
                  }
              },
              rules: {
                Name: {
                  required: true,
                },
                Name_type: {
                  required: true,
                },
                Address: {
                  required: true,
                },
                H_p_no: {
                  required: true,
                },
                Dob: {
                  required: true,
                },
                Marital_status: {
                  required: true,
                },
                Occupation: {
                  required: true,
                },
                Emergency_number: {
                  required: true,
                },
                Plastic_Surgery_Face: {
                  required: true,
                },
                Plastic_Surgery_Body: {
                  required: true,
                },
                Pregnant: {
                  required: true,
                },
                Medications: {
                  required: true,
                },
                Skin_Allergy: {
                  required: true,
                },
                Skin_Type_Specify: {
                  required: true,
                },
                Service_Focus_Remark: {
                  required: true,
                },
                Last_Facial_Treatment: {
                  required: true,
                },
                Skincare_Routine_At_Home: {
                  required: true,
                },
                Last_Body_Treatment: {
                  required: true,
                },
                Body_Allergy_Sensitive: {
                  required: true,
                },
                Joint_Condition: {
                  required: true,
                },
                Bone_Condition: {
                  required: true,
                },
                Circulatory_Condition: {
                  required: true,
                },
                Diabetes: {
                  required: true,
                },
                Customer_Sign: {
                  required: true,
                },
                'Service_Focus[]': {
                  required: true,
                }
              },
              submitHandler: function(form) {
                form.submit();
              }
            });
          });
      </script>
@endsection
