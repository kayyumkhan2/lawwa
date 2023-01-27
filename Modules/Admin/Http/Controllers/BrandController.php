<?php

namespace Modules\Admin\Http\Controllers;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Route;
use Auth;
use Hash;
use Mail;
use App\Models\Brand;


class BrandController extends Controller {

  

    
    public function index() {
        try {
            $brands = Brand::orderBy("id", "desc")->get();
            return view('admin.brands.index')->with('brands', $brands);
        } catch (Exception $ex) {
            Toastr::error('Either something went wrong or invalid access!', 'Error');
            return redirect()->back()->with('errors', "Either something went wrong or invalid access!");
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create() {
        try {
            return view('admin.brands.create');
        } catch (Exception $ex) {
            Toastr::error('Either something went wrong or invalid access!', 'Error');
            return redirect()->back()->with('errors', "Either something went wrong or invalid access!");
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request) {
      


                    $validatedData = $request->validate([
                       'name' => 'required|string|max:100|unique:brands',
                        'brand_logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                        'description' => 'required|string|max:1000',
                    ]);

                if ($request->hasfile("brand_logo")){
                    $imageName = time().'.'.$request->brand_logo->extension(); 
                    $request->brand_logo->move(public_path('public/images/brands'),$imageName);
                    $validatedData['brand_logo'] =$imageName;
                }
                    $services = Brand::create($validatedData);
                     alert()->Success('Success', 'Brand add Successfully')->autoclose(3000);
                    return redirect()->route('brands.index');

      
        }
    

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($slug) {
        try {
            $brand = [];
            if ($slug != null) {
                $brand = Brand::where('slug', $slug)->first();
            }
            return view('admin::brands.show', compact('brand'));
        } catch (\Exception $e) {
            Toastr::error('Either something went wrong or invalid access!', 'Error');
            return redirect()->back()->with('errors', "Either something went wrong or invalid access!");
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id) {

                $brand = Brand::findOrFail($id);

            return view('admin.brands.edit', compact('brand'));
    
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, Brand $Brand) {
        
                    $validatedData = $request->validate([
                        'name' => 'unique:brands,name,' . $Brand->id,
                        'brand_logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                        'description' => 'required|string|max:1000',
                    ]);

                if ($request->hasfile("brand_logo")){
                    $imageName = time().'.'.$request->brand_logo->extension(); 
                    $request->brand_logo->move(public_path('public/images/brands'),$imageName);
                    $validatedData['brand_logo'] =$imageName;
                }
                     $Brand->update($validatedData);
                     alert()->Success('Success', 'Brand update Successfully')->autoclose(3000);
                    return redirect()->route('brands.index');

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
//    public function destroy($slug) {
//        try {
//            $this->Brand->where('slug', $slug)->delete();
//            Toastr::success('Brand remove successfully.', 'Success');
//            return redirect('admin/brands')->withSuccess("Brand remove successfully.");
//        } catch (\Exception $e) {
//            Toastr::error('Either something went wrong or invalid access!', 'Error');
//            return redirect()->back()->with('errors', "Either something went wrong or invalid access!");
//        }
//    }


    public function destroy(Request $request) {
        $data = $request->all();
        if (isset($data['slug'])) {
            try {
                $this->Brand->where('slug', $data['slug'])->delete();
                return json_encode(['status' => 200]);
            } catch (\Exception $e) {
                return json_encode(['status' => 500]);
            }
        } else {
            return json_encode(['status' => 500]);
        }
    }

//    public function brandStatus($slug) {
//        $explode = explode('_', $slug);
//        if (trim($explode[1]) == 0 || trim($explode[1]) == 1) {
//            try {
//                $this->Brand->where('slug', $explode[0])->update(['status' => $explode[1]]);
//                Toastr::success('Brand status has been updated successfully.', 'Success');
//                return redirect('admin/brands')->withSuccess("Brand status has been updated successfully.");
//            } catch (\Exception $e) {
//                Toastr::error('Either something went wrong or invalid access!', 'Error');
//                return redirect()->back()->with('errors', "Either something went wrong or invalid access!");
//            }
//        }
//    }

    public function brandStatus(Request $request) {
        $data = $request->all();
        if ($data['status'] == 0 || $data['status'] == 1) {
            try {
                if ($data['status'] == 1) {
                    $this->Brand->where('slug', $data['slug'])->update(['status' => $data['status']]);
                    return json_encode(['status' => 200]);
                } else {
                    $this->Brand->where('slug', $data['slug'])->update(['status' => $data['status']]);
                    return json_encode(['status' => 201]);
                }
            } catch (\Exception $e) {
                return json_encode(['status' => 500]);
            }
        }
    }

}
