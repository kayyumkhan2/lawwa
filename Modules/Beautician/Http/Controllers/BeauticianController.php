<?php

namespace Modules\Beautician\Http\Controllers;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Models\{Country,State,City,UserAddress,ProfileInformation,Service,User,BeauticianService,BeauticianGallery};
use Illuminate\Support\Facades\Input;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Validator;
use Auth;
use Illuminate\Auth\Events\Registered;
class BeauticianController extends Controller
{
    public function signup(){
        $services = Service::orderBy('id','DESC')->get();
        return view('beautician::Auth.sign-up',compact('services'));
    }

    public function login(){
        return redirect()->route('login');
    }
    
    public function resetpassword(){
        return view('beautician::Auth.reset-password');
    }
    
    public function create(){
        return view('beautician::create');
    }
    public function myaccount(){
       $countries = Country::get(["name","id"]);
       $services = Service::get();
       $BeauticianGallery = BeauticianGallery::where('user_id',Auth::id())->orderBy('created_at','DESC')->limit(3)->get();
       return view('beautician::my-account',compact('countries','services','BeauticianGallery'));
    }
    public function signuppost(Request $request){
         //dd($request);
        $request->validate([
            'full_name' => 'required',
            'profile_pic' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'phone_no' => 'required |unique:users',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm_password|min:6',
            'id_proof' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3048',
        ],
        [
            'id_proof.max' => 'Please select the 3 Mb bellow file in id proof!',
        ]);
             $input = $request->all();
             $input["password"] = Hash::make($input["password"]);
             $input["status"] = '0';
             $user = User::create($input);
             CreateNotification("NewBeautician",$user,$user->id,"New beautician registered successfully");
             $user->assignRole("Beautician");
            if ($request->hasfile("doc")){
                $BeauticianDocs['doc'] =uploadImg($request->doc,"beauticiansdocs");
                $BeauticianDocs['name'] ="certificate";
                $xyz = $user->BeauticianDocs()->create($BeauticianDocs);
            }
            if ($request->hasfile("id_proof")){
                $UserProfileInformation['Id_Proof']= uploadImg($request->id_proof,"beauticiansdocs");
                $user->UserProfileInformation()->create($UserProfileInformation); 

            }
            if ($request->has("certifiedstatus")){
                foreach(request('services') as $service_id) {
                    $BeauticianDocs['service_id'] =$service_id;
                    $user->BeauticianServices()->create($BeauticianDocs);    
                }
            } 
            event(new Registered($user));
        alert()->Success('Thank you', 'You have successfully register')->autoclose(4000);
        return redirect()->route('beautician.login');
     }
     public function GetAddress(){
        $address = UserAddress::where('user_id',Auth::id())->get();
        $data = '';
         foreach ($address as $key => $value) {
             $data .= "<span class='notification".$value->id."'><b class='link ml-3 float-right pointer edit-address' data-toggle='collapse' data-target='#collapseExample' aria-expanded='false' aria-controls='collapseExample' data-model='UserAddress' data-Country='".$value->Country."'  data-State_Province_Region='".$value->State_Province_Region."'   data-id='".$value->id."' data-address_id='".$value->id."' data-town_city='".$value->Town_City."'  data-Address_line1='".$value->Address_line1."'  data-type='".$value->Type."' data-Zip_Postcode='".$value->Zip_Postcode."' data-name='".$value->Name."' data-MobileNumber='".$value->MobileNumber."'>Edit</b><b class='delete-address pointer link float-right' data-model='UserAddress' data-id=".$value->id."  id=".$value->id.">Delete</b>&#160 <div class='fixed-textarea'><span class='add-edit-type'>".$value->Type."</span><textarea class='form-control' value=".$value->Address_line1." placeholder='".$value->Name.", ".$value->MobileNumber.", ".$value->Address_line1." (".$value->Zip_Postcode.") ".$value->GetCity->name.", ".$value->GetState->name.", ".$value->GetCountry->name. "' readonly=''></textarea></div><br><span>";
          }
        echo json_encode($data);
    }
     public function AddAddress(Request $request) { 
        $validation  = Validator::make($request->all(), [ 
            'Name' => 'required',
            'MobileNumber' => 'required|numeric',  
            'Country' => 'required', 
            'State_Province_Region' => 'required',
            'Town_City' => 'required',
            'Zip_Postcode' => 'required',
            'Type' => 'required',
            'Address_line1' => 'required',
        ]);
        $error_array = array();
        $success_output = '';
        if ($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }
        }
        else{
        $user_id =Auth::id();
        $input = $request->all();
        $input['user_id']=$user_id;
        if ($request->address_id!="null") {
            $request->request->remove("_token");
            $address_id= $request->address_id;
            $request->request->remove("address_id");
            $input = $request->all();
            $address = UserAddress::where('id',$address_id)->update($input);
            $success_output = '<div class="alert alert-success">Address Update Successfully</div>';
        }
        else{
            $address = UserAddress::create($input); 
            $success_output = '<div class="alert alert-success">Address add Successfully</div>';
        }
        }
          $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );
        echo json_encode($output);
    }
    public function ChangePassword(Request $request){
        $error_array = array();
        $success_output = '';
        $validation  = Validator::make($request->all(), [ 
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);
        
        if ($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }
        }
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
             $success_output =  '<div class="alert alert-danger">Your current password does not matches with the password you provided. Please try again... </div>';
        }

        elseif(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            $success_output =  '<div class="alert alert-danger">New Password cannot be same as your current password. Please choose a different password... </div>';
        }
        else{
            $user = Auth::user();
            $user->password = bcrypt($request->get('new-password'));
            $success_output= $user->save();
            $success_output = '<div class="alert alert-success">Password Update Successfully</div>';
        }

        //Change Password
        
        $output = array(
          'error'     =>  $error_array,
          'success'   =>  $success_output
        );
        echo json_encode($output);
    }
  
    public function UpdateProfileInformation(Request $request){
      $validation  = Validator::make($request->all(), [ 
        'full_name' => 'required',
        'phone_no' => 'required|digits_between:7,12|numeric|unique:users,phone_no,'.Auth::id(),
        'Address_Location' => 'required',
        'email' => 'required|email|unique:users,email,'.Auth::id(),
        "services" => 'required|array|min:1',
        "services.*"  => "required|string|distinct|min:1",
        'Gender' => 'required',
        ]);
      $error_array = array();
        $success_output = '';
        if ($validation->fails()){
          foreach($validation->messages()->getMessages() as $field_name => $messages){
            $error_array[] = $messages;
          }
        }
      $input = $request->all();         
     if ($request->hasfile("profile_pic")){
          $url= url('/');
          $imageName = time().'.'.$request->profile_pic->extension(); 
          $request->profile_pic->move(public_path('public/images/profilepics'), $imageName);
          $destinationPath = 'public/images/profilepics/';  
          $input['profile_pic'] =$imageName;
        }
        if (!count($error_array)>0) {
            Auth::user()->update($input);
        }

       if ($request->has("services")){
            Auth::user()->BeauticianServices()->delete();
            foreach(request('services') as $service_id) {
                $BeauticianDocs['service_id'] =$service_id;
                Auth::user()->BeauticianServices()->create($BeauticianDocs);    
            }
        }    
      if (!empty(Auth::user()->UserProfileInformation)) {
          Auth::user()->UserProfileInformation()->Update([
          'Gender' => $request->Gender,
          'About_us' => $request->About_us,
        ]);
           $success_output = '<div class="alert alert-success">Profile Update Successfully</div>';
      }
      else{
          Auth::user()->UserProfileInformation()->Create([
          'Gender' => $request->Gender,
          'About_us' => $request->About_us,
          ]);
          $success_output = '<div class="alert alert-success">Profile Update Successfully</div>';
        
        }  
          $output = array(
          'error'     =>  $error_array,
          'success'   =>  $success_output
        );
        echo json_encode($output);
    }
    public function UpdateProfilePic(Request $request){ 
        $input = $request->all();
        // dd($input);
        $validation  = Validator::make($request->all(), [ 
          'profile_pic' => 'required',
        ]);
        $error_array = array();
        $success_output = '';
        if ($validation->fails()){
          foreach($validation->messages()->getMessages() as $field_name => $messages){
            $error_array[] = $messages;
          }
        }
    if ($request->hasfile("profile_pic")){
          $url= url('/');
          $imageName = time().'.'.$request->profile_pic->extension(); 
          $request->profile_pic->move(public_path('public/images/profilepics'), $imageName);
          $destinationPath = 'public/images/profilepics/';  
          $request['profile_pic'] =$imageName;
          $request->request->remove("_token");
          $request->request->remove("_method");
          $input['profile_pic'] =$imageName;
      } 
        $user=Auth::user();
        $user->profile_pic = $imageName;
        if($user->save()){
            $success_output = 'Profile Picture updated Successfully';
        }
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output,
            'imageName'   =>  $imageName
        );
        echo json_encode($output); 
    }
    
    public function loadimagesAjax(Request $request)
    {
      $output = '';
      $id = $request->id;
      $BeauticianGallery = BeauticianGallery::where('user_id',Auth::id())->where('id','<',$id)->orderBy('created_at','DESC')->limit(3)->get();
      if(!$BeauticianGallery->isEmpty())
      {
        foreach($BeauticianGallery as $images)
        {
          $url    = url('images/beauticiangalleryimages/'.$images->image);                          
          $output .= '<div class="col-md-4">
                        <a href="#0" class="img-block">
                          <div class="lawwa-table-wrap">
                            <div class="lawwa-align-wrap">
                              <img src="'.$url.'" alt="image">
                            </div>
                          </div>
                        </a>
                      </div>';
        }
        $output .= '<div id="remove-row" class="btn-block">
                        <button id="btn-more" data-id="'.$images->id.'" class="lawwa-btn" > Load More </button>
                      </div>';
        echo $output;
      }
    }
     public function UploadGalleryImages(Request $request){ 
       $input = $request->all();
      // dd($input);
       $error_array = array();
        $success_output = '';
    if ($request->hasfile("image")){
        $imageName = time().'.'.$request->image->extension(); 
        $request->image->move(public_path('images/beauticiangalleryimages'), $imageName);
        $request->request->remove("_token");
        $request->request->remove("_method");
      } 
        $upload=BeauticianGallery::firstOrCreate([
          'user_id' => Auth::id(),
          'image'   =>$imageName
        ]);
        
        if($upload=!"") {
            $success_output = '<div class="alert alert-success">Update Successfully</div>';
        }
        else
        {
          $success_output = '<div class="alert alert-danger">Please try again.</div>';  
        }

        $output = array(
          'error'     =>  $error_array,
          'success'   =>  $success_output
        );
        echo json_encode($output);
     }
}
