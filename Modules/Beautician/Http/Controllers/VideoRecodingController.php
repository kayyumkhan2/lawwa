<?php
namespace Modules\Beautician\Http\Controllers;
use Illuminate\Routing\Controller;
use App\Models\VideoRecoding;
use Illuminate\Http\Request;

class VideoRecodingController extends Controller
{
      
public  function uploadvideo($image, $foldername){
        try{
          if (!empty($image)) {
              $imageName = rand().'.'.$image->extension(); 
              $image->move(public_path('/'.$foldername),$imageName);
             return $imageName;
          }
        }
        catch(Exception $e){
          throw $e;
        }
    } 

    public function store(Request $request)
    {
        if ($request->hasFile('video')) {
            if ($request->hasfile('video')){
                 $video= $this->uploadvideo($request->video,"videos");
              } 
            $media = VideoRecoding::create(['file_name' => $video,'booking_id'=>$request->booking_id]);
            return  response()->json(['success' => ($media) ? 1 : 0, 'message' => ($media) ? 'Video uploaded successfully.' : "Some thing went wrong. Try again !."]);
        }
    }
}
