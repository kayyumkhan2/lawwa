<?php
namespace Modules\Admin\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Address;
use App\Models\Email;
use App\Models\ContactNumber;
use App\Models\Bank;
use App\Models\HomePageContent;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
class SettingController extends Controller
{
    public function index(Request $request,$id=null )
    {
        $requesttype = "index";
         $updatedata='';
        switch ($requesttype) {
          case $request->routeIs('settings.contactussettings.address*'):
                $data = Address::orderBy('id', 'desc')->get();
                if ($id) {
            try {
                  $updatedata = Address::findorfail($id);
                } catch (\Exception $ex) {
                  return redirect()->route('settings.contactussettings.address');
                } 
              }
            return view('admin::settings.contactussettings.address.index', compact('data','id','updatedata'));   
            break;
          case $request->routeIs('settings.homepagecontent*'):
                $data = HomePageContent::orderBy('id', 'desc')->get();
                if ($id) {
                  $updatedata = HomePageContent::find($id);
                  if ($updatedata=="") {
                    $addresses = HomePageContent::create(["about_us_text"=>"about_us_text","membership_text"=>"membership_text","contact_us_text"=>"contact_us_text","about_us_image"=>"about_us_image","about_us_video"=>"about_us_video"]);
                  }
                }
            return view('admin::settings.homepagecontent.index', compact('data','id','updatedata'));   
            break;
          case $request->routeIs('settings.contactussettings.email*'):
               if ($id) { $updatedata = Email::findorfail($id);}
                $data = Email::orderBy('id', 'desc')->get();
            return view('admin::settings.contactussettings.email.index', compact('data','id','updatedata'));
            break;
          case $request->routeIs('settings.bank.index*'):
               if ($id) { $updatedata = Bank::findorfail($id);}
                $data = Bank::orderBy('id', 'desc')->get();
            return view('admin::settings.banks.index', compact('data','id','updatedata'));
            break;
          case $request->routeIs('settings.contactussettings.contactnumber*'):
               if ($id) {
               try {
                  $updatedata = ContactNumber::findorfail($id);
                } catch (\Exception $ex) {
                  return redirect()->route('settings.contactussettings.contactnumber');
                }  
              }
                $data = ContactNumber::orderBy('id', 'desc')->get();
            return view('admin::settings.contactussettings.contactnumber.index', compact('data','id','updatedata'));
          break;
          default:
           $data = Setting::orderBy('id', 'desc')->get();
           return view('admin::settings.index', compact('data'));
        }

         
    }
    public function contactussettings()
    {
       return view('admin::settings.create');
    }
    
    public function Addressstore(Request $request,$id=null){ 
      $validatedData = $request->validate([
          'title' => 'required|string|max:100',
          'address' => 'required|string|max:500',
        ]);
      if($request->has('default_status')) 
          {
            $validatedData['default_status']  = request('default_status');
            if (request('default_status')==1) {
               Address::where('default_status', '1')->update(['default_status' => '0']);
            }
          }
     if ($id) {
     try {
          $updatedata = Address::findorfail($id);
          } catch (\Exception $ex) {
          return redirect()->route('settings.contactussettings.address');
        }
          $addresses = Address::where('id',$id)->update($validatedData);
          alert()->Success('Success', 'address update Successfully')->autoclose(3000);
          return redirect()->back();
        }
         $addresses = Address::create($validatedData);
         alert()->Success('Success', 'address add Successfully')->autoclose(3000);
        return redirect()->back();

    }        
    public function Emailstore(Request $request,$id=null){
      $validatedData = $request->validate([
          'title' => 'required|string|max:100',
          'mail_id' => 'required|string|max:200',
        ]);
       if($request->has('default_status')) 
          {
            $validatedData['default_status']  = request('default_status');
            if (request('default_status')==1) {
               Email::where('default_status', '1')->update(['default_status' => '0']);
            }
          }
     if ($id) {
     try {
          $updatedata = Email::findorfail($id);
          } catch (\Exception $ex) {
          return redirect()->route('settings.contactussettings.contactnumber');
        } 
           $addresses = Email::where('id',$id)->update($validatedData);
           alert()->Success('Success', 'Email update Successfully')->autoclose(3000);
          return redirect()->back();
        }
         $addresses = Email::create($validatedData);
         alert()->Success('Success', 'Email add Successfully')->autoclose(3000);
        return redirect()->back();
    }

    public function Contactnumberstore(Request $request,$id=null ){
      $validatedData = $request->validate([
          'title' => 'required|string|max:100',
          'number' => 'required|string|max:20',
        ]);
      if($request->has('default_status')) 
          {
            $validatedData['default_status']  = request('default_status');
            if (request('default_status')==1) {
               ContactNumber::where('default_status', '1')->update(['default_status' => '0']);
            }
          }
      if ($id) {
      try {
          $updatedata = ContactNumber::findorfail($id);
          } catch (\Exception $ex) {
          return redirect()->route('settings.contactussettings.contactnumber');
      } 
           $addresses = ContactNumber::where('id',$id)->update($validatedData);
           alert()->Success('Success', 'contact number update Successfully')->autoclose(3000);
          return redirect()->back();
        }
         $addresses = ContactNumber::create($validatedData);
         alert()->Success('Success', 'contact number add Successfully')->autoclose(3000);
        return redirect()->back();
    } 
    public function BankNamestore(Request $request,$id=null ){
      $validatedData = $request->validate([
          'name' => 'required|string|max:300',
        ]);
      if($request->has('default_status')) 
          {
            $validatedData['default_status']  = request('default_status');
            if (request('default_status')==1) {
               Bank::where('default_status', '1')->update(['default_status' => '0']);
            }
          }
      if ($id) {
      try {
          $updatedata = Bank::findorfail($id);
          } catch (\Exception $ex) {
          return redirect()->route('settings.contactussettings.contactnumber');
      } 
           $addresses = Bank::where('id',$id)->update($validatedData);
           alert()->Success('Success', 'contact number update Successfully')->autoclose(3000);
          return redirect()->back();
        }
         $addresses = Bank::create($validatedData);
         alert()->Success('Success', 'contact number add Successfully')->autoclose(3000);
        return redirect()->back();
    }
    public function Homepagecontentstore(Request $request,$id=1)
    {
      $validatedData = $request->validate([
          'about_us_text' => 'required|string|max:3000',
          'membership_text' => 'required|string|max:1000',
          'contact_us_text' => 'required|string|max:1000',
        ]);
      if ($request->hasfile("about_us_image")){
        $validatedData['about_us_image']= uploadImg($request->about_us_image,"frontpages/aboutusimages");
      }
      if ($request->hasfile("about_us_video")){
        $validatedData['about_us_video']= uploadImg($request->about_us_video,"frontpages/homepagevideos");
      }
     if ($id) {
     try {
          $updatedata = HomePageContent::findorfail($id);
          } catch (\Exception $ex) {
          return redirect()->route('settings.contactussettings.contactnumber');
        } 
           $addresses = HomePageContent::where('id',$id)->update($validatedData);
           alert()->Success('Success', 'Home page update Successfully')->autoclose(3000);
          return redirect()->back();
        }

         $addresses = HomePageContent::create($validatedData);
         alert()->Success('Success', 'Home page add Successfully')->autoclose(3000);
        return redirect()->back();
    }

    public function edit($Setting)
    {
      $Setting = Setting::findorfail($Setting);
      return view('admin::settings.edit', compact('Setting'));
    }


    public function update(Request $request, $id)
    {
        
      $Setting = Setting::find($id);
      if($request->has('BeauticianCommission')) 
          {
            $Setting->BeauticianCommission  = request('BeauticianCommission');
          }
      if($request->has('ShippingCharges')) 
         {
            $Setting->ShippingCharges  = request('ShippingCharges');
         }
      if($request->has('ChargeCondition')) 
         {
            $Setting->ChargeCondition  = request('ChargeCondition');
         }
      $Setting->save();
      toastr()->success('Setting updated successfully!');
      return redirect()->route('settings.index');
    }
}
