<?php

namespace Modules\Customer\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\User;
use App\Models\{Country,State,City,UserAddress,ProfileInformation};
use Illuminate\Support\Facades\Input;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Validator;
use Auth;
use Illuminate\Auth\Events\Registered;
class CustomerController extends Controller
{
    
    public function signup(){
        return view('customer::Auth.sign-up');
    }
    
    public function login(){
        return view('customer::Auth.login');
    }
    
    public function resetpassword(){
        return view('customer::Auth.reset-password');
    }

    public function create(){
        return view('customer::create');
    }
    
    public function signuppost(Request $request){
      if (!Auth::check()){ 
        $request->validate([
        'full_name' => 'required',
        'Address_Location' => 'required',
        'profile_pic' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'Id_Proof' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3048',
        'Photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3048',
        'phone_no' => 'required |unique:users',
        'Emergency_Number' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|same:confirm_password|min:6',
    ],
    [
        'Id_Proof.max' => 'Please select the 3 Mb bellow file in id proof!',
        'Photo.max' => 'Please select the 2 Mb bellow file in Photo!',
        'profile_pic.max' => 'Please select the 2 Mb bellow file in profile pic!',
    ]);
        $input = $request->all();
        $input["password"] = Hash::make($input["password"]);
        $input["status"] = '1';
        $UserProfileInformation['Emergency_Number'] =$request->Emergency_Number;
        $user = User::create($input);
        CreateNotification("NewCutomer",$user,$user->id,"New customer registered successfully");
        $user->assignRole("Customer"); 
        event(new Registered($user));
        if ($request->hasfile("Id_Proof")){
                $UserProfileInformation['Id_Proof']= uploadImg($request->Id_Proof,"customerphotos");
            }
       if ($request->has('membership')) {
            $UserProfileInformation['Nric']  =$request->Nric;
            if ($request->hasfile("Photo")){
                $UserProfileInformation['Photo']= uploadImg($request->Photo,"customerphotos");
        }
          $user->UserProfileInformation()->create($UserProfileInformation);
           Auth::login($user);
           alert()->Success('Success', 'Welcome! Registered successfully')->autoclose(4000);
           return back();     
        }

        $user->UserProfileInformation()->create($UserProfileInformation);
        alert()->Success('Success', 'Welcome! Registered successfully')->autoclose(4000);
        return redirect()->route('customer.login');
      }

      else
      {
        if ($request->has('membership')) {
            $user =Auth::user();
            $UserProfileInformation['Nric']  =$request->Nric;
            if ($request->hasfile("Photo")){
                $UserProfileInformation['Photo']= uploadImg($request->Photo,"customerphotos");
            }
            if ($request->hasfile("Id_Proof")){
                $UserProfileInformation['Id_Proof']= uploadImg($request->Id_Proof,"customerphotos");
            }
            $UserProfileInformation['Emergency_Number'] =$request->Emergency_Number;
            $user->UserProfileInformation()->update($UserProfileInformation);
           Auth::login($user);
           alert()->Success('Success', 'Done! updated successfully')->autoclose(4000);
           return back();     
        }
      }
    }
    public function GetAddress(){
        $address = UserAddress::where('user_id',Auth::id())->get();
        $data = '';
         foreach ($address as $key => $value) {
             $data .= "<span class='notification".$value->id."'><b class='link ml-3 pointer float-right edit-address' data-model='UserAddress' data-Country='".$value->Country."'  data-State_Province_Region='".$value->State_Province_Region."'   data-id='".$value->id."' data-address_id='".$value->id."' data-town_city='".$value->Town_City."'  data-Address_line1='".$value->Address_line1."'  data-type='".$value->Type."' data-Zip_Postcode='".$value->Zip_Postcode."' data-name='".$value->Name."' data-MobileNumber='".$value->MobileNumber."'>Edit</b><b class='delete-address pointer link float-right' data-model='UserAddress' data-id=".$value->id."  id=".$value->id.">Delete</b>&#160 <div class='fixed-textarea'><span class='add-edit-type'>".$value->Type."</span><textarea class='form-control' value=".$value->Address_line1." placeholder='".$value->Name.", ".$value->MobileNumber.", ".$value->Address_line1." (".$value->Zip_Postcode.") ".$value->GetCity->name.", ".$value->GetState->name.", ".$value->GetCountry->name. "' readonly=''></textarea></div><br><span>";
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
            $success_output = 'Address Update Successfully';
        }
        else{
            $address = UserAddress::create($input); 
            $success_output = 'Address Add Successfully';
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
        if($validation->fails()){
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
          $success_output = '<div class="alert alert-success">Password Change Successfully</div>';
        }
        //Change Password
        $output = array(
          'error'     =>  $error_array,
          'success'   =>  $success_output
        );
        echo json_encode($output);
    }
    public function myaccount(){
       $data['countries'] = Country::get(["name","id"]);
       return view('customer::my-account',$data);
    }

    public function edit($id){
      return view('customer::edit');
    }

    public function UpdateProfileInformation(Request $request){
      $validation  = Validator::make($request->all(), [ 
        'full_name' => 'required',
        'phone_no' => 'required|numeric|unique:users,phone_no,'.Auth::id(),
        'Address_Location' => 'required',
        'email' => 'required|email|unique:users,email,'.Auth::id(),
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
      if (!empty(Auth::user()->UserProfileInformation)) {
          Auth::user()->UserProfileInformation()->Update([
          'Gender' => $request->Gender,
        ]);
           $success_output = 'Profile Update Successfully';
      }
      else{
          Auth::user()->UserProfileInformation()->Create([
          'Gender' => $request->Gender,
          ]);
          $success_output = 'Profile Update Successfully';
        
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
    
    

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
