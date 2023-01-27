<?php
namespace Modules\Front\Http\Controllers;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Models\{Product,ProductCart,Order,OrderProduct,UserAddress};
use App\Models\{Country,State,City};
use Illuminate\Support\Facades\{Input,Http};
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Billplz\Client;
use Illuminate\Http\Client\Response;
use Validator;
use Auth;
class ProductCartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function showcart()
    {
      try
      { 
         return view('front::productcart.product-cart');

      } 
      catch(ModelNotFoundException $e) 
      {
         return response()->json(["message"=>"error","code"=> "404",'error'=>"something went ot wrong",'data' => new \stdClass()], 404); 
      }
    }
    public function Checkout()
    {
      if (((Auth::user()->ProductCarts)->count())<=0) {
                alert()->info('error', 'Your cart is empty')->autoclose(3000);
                return redirect()->back();
      }
      try
      { 
         $data['countries'] = Country::get(["name","id"]);
         return view('front::productcart.checkout',$data);
      } 
      catch(ModelNotFoundException $e) 
      {
         return response()->json(["message"=>"error","code"=> "404",'error'=>"something went ot wrong",'data' => new \stdClass()], 404); 
      }
    }
    public function CheckoutStore(Request $Request)
    {
       $selected_address = UserAddress::findorfail($Request->selected_address);
       //insert address id to session for access on payment success page
       session(['address_id' => $Request->selected_address]);
       $address_type     = $selected_address->Type;
       $address          = $selected_address->Name.' , '.$selected_address->MobileNumber.' , '.$selected_address->Address_line1.' , '.$selected_address->GetCity->name.','.$selected_address->Zip_Postcode.' ('.$selected_address->GetState->name.') , '.$selected_address->GetCountry->name;
      try
      { 
        $data          = '';
        $totalquantity = 0;
        $totalsaleprice= 0;
        $sub_total     = 0;
        $products      = [];
        $ShippingCharges = 0;
        foreach (Auth::user()->ProductCarts as $key => $value){
          $product        = new OrderProduct;
          $productimage   = $value->product_thumbnail;
          $totalquantity  += $value->pivot->quantity;
          $totalsaleprice += ($value->sale_price)*$value->pivot->quantity;
          $sub_total      += $value->sale_price;

          $product->product_name     = ($value->name);
          $product->product_image    = $productimage;
          $product->product_price    = $value->sale_price;
          $product->product_quantity = $value->pivot->quantity;
          $product->product_id       = $value->id;
          $product->order_id         = $value->service_id;
          $product->size             = $value->pivot->size;
          $product->color            = $value->pivot->color;
          $product->unit             = $value->unit ? $value->unit ." ". $value->unit_type : ''  ; 
          array_push($products,$product);
        }
        if($totalsaleprice<Setting()->ChargeCondition && $totalsaleprice>0 ) {
          $totalsaleprice =$totalsaleprice+ Setting()->ShippingCharges;
          $ShippingCharges=Setting()->ShippingCharges;
        }
        $billplz = Client::make('289ad88c-ca09-42a3-a6e3-46ad93b96fe4');
        $billplz->useSandbox();
        $bill = $billplz->bill();
        $email=Auth::user()->email;
        $full_name=Auth::user()->full_name ? Auth::user()->full_name : $selected_address->Name ;
        $response = $bill->create(
          'lusclvw8',
          "$email",
           null,
          "$full_name",
          \Duit\MYR::given($totalsaleprice*100),
          'https://lawwa.ezxdemo.com/admin',
          'Maecenas eu placerat ante.',
          ['redirect_url' => url("payment")]
        );
        $data=$response->toArray();
        $url=$data['url'];
        if($response->getStatusCode() !== 200) {
          throw new SomethingHasGoneReallyBadException();
        }
        $order = Order::create([
          'user_name'      =>Auth::user()->full_name,
          'total_price'    => $totalsaleprice,
          'total_quantity' => $totalquantity,
          'ShippingCharges' => $ShippingCharges,
          'user_id'        => Auth::id(),
          'txn_id'         => $data['id'],
          'address'        => $address,
          'address_type'   => $address_type,
          'shipping_option'=> $Request->shipping_option
      ]);
        $order->OrderProducts()->saveMany($products);
        $order->OrderStatus()->create($products);
        return redirect($url);

      } 
      catch(ModelNotFoundException $e) 
      {
        return response()->json(["message"=>"error","code"=> "404",'error'=>"something went ot wrong",'data' => new \stdClass()], 404); 
      }
    }

    public function emptyproductcart()
    {
      try
         { 
          $ProductCart= ProductCart::where('user_id' , Auth::user()->id)->first();
      } 
      catch(ModelNotFoundException $e)
          {
              return response()->json(["message"=>"error","code"=> "404",'error'=>"something went ot wrong",'data' => new \stdClass()], 404);
      }
      if(!$ProductCart=="")
        {
          $Cart=ProductCart::where('user_id' , Auth::user()->id)->delete();
          if($Cart)
          {
              return response()->json(["message"=>"product add successfully","code"=> "200",'error'=>new \stdClass(),'data' => new \stdClass()], 200); 
          }
          else
          {
              return response()->json(["message"=>"error","code"=> "404",'error'=>"something went ot wrong",'data' => new \stdClass()], 404);
          }

      }        
    }

    public function GetProductCart()
    {
      $data = '';
      $totalquantity = 0;
      $totalprice = 0;
      $sub_total = 0;
      $totalsaleprice = 0;
      $ShippingCharges = 0;
      foreach (Auth::user()->ProductCarts as $key => $value) {
      $totalquantity+= $value->pivot->quantity;
      $sub_total+= $value->sale_price;
      $totalsaleprice+= ($value->sale_price)*$value->pivot->quantity;
        $totalprice+= ($value->price)*$value->pivot->quantity;
         $data.= '
         <div class="singal-cart">
          <div class="table-responsive">
            <table class="table mb-0">
              <tbody>
              <tr>
                <td>
                  <table class="table mb-0">
                    <tbody>
                    <tr>
                      <td>
                        <div class="img-block">
                          <div class="lawwa-table-wrap">
                            <div class="lawwa-align-wrap">
                              <img src="'.asset('images/productsimages/'.$value->product_thumbnail).'" alt="Cart">
                            </div>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="cart-info">
                          <h4><a href='.route('product-details',$value->id).'>'.$value->name.'</a></h4>
                          <h2>RM '.$value->sale_price.'<span>RM '.$value->price.'</span></h2>
                          <span class="link">'.round((($value->price  - $value->sale_price )*100) /$value->price).'% OFF</span>
                            <div class="quantity">
                              <div class="form-group">
                                <span data-product_id="'.$value->pivot->product_id.'" id="product_id"></span>
                                <label for="quantity'.$value->pivot->product_id.'">Quantity</label>
                                <input type="number" id="quantity'.$value->pivot->product_id.'" readonly=""  class="form-control ProductCartCount" min="1" max="10" step="1" value='.$value->pivot->quantity.'>
                                <div class="quantity-nav">
                                  <div class="quantity-button increment quantity-up" data-product_id_up="'.$value->pivot->product_id.'">+</div>
                                  <div class="quantity-button decrement quantity-down" data-product_id_down='.$value->pivot->product_id.'>-</div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </td>
                      <td align="right">
                        <div class="cart-right-info">
                          <div class="delivery-block">
                            <span>Delivery in 2 - 3 days</span>
                            <span>Free</span>
                          </div>
                          <div class="price-info">
                            <span>Price</span>
                            <span>'.$value->sale_price*$value->pivot->quantity.'</span>
                          </div>
                          <ul class="right-list">
                            <li><a href="javascript:void(0)" class="link RemoveItemToProductCart" data-product_id="'.$value->pivot->product_id.'">Delete</a></li>
                          </ul>
                        </div>
                      </td>
                    </tr>
                  </tbody></table>
                </td>
              </tr>
            </tbody></table>
          </div>
        </div>';
          }
        $totaldiscount=$totalprice-$totalsaleprice; 
        if($totalsaleprice<Setting()->ChargeCondition && $totalsaleprice>0 ) {
          $totalsaleprice =$totalsaleprice+ Setting()->ShippingCharges;
          $ShippingCharges=Setting()->ShippingCharges;
        }
        return response()->json(["message"=>"success","ShippingCharges"=>"$ShippingCharges","totaldiscount"=>$totaldiscount,"totalsaleprice"=>$totalsaleprice,"sub_total"=>$totalprice,"totalquantity"=> $totalquantity,"totalprice"=> $totalprice,'error'=>new \stdClass(),'data' =>$data], 200); 
    }
    public function CheckOutCart()
    {
      $data = '';
      $totalquantity = 0;
      $totalsaleprice = 0;
      $totalprice = 0;
      $sub_total = 0;
      $ShippingCharges = 0;
      foreach (Auth::user()->ProductCarts as $key => $value) {
      $totalquantity+= $value->pivot->quantity;
      $totalsaleprice+= ($value->sale_price)*$value->pivot->quantity;
      $totalprice+= ($value->price)*$value->pivot->quantity;
      $sub_total+= ($value->price)*$value->pivot->quantity;
      $products_total_price= ($value->sale_price)*$value->pivot->quantity;
      $data.='
        <div class="order-summary singal-cart">
          <div class="table-responsive">
            <table class="table mb-0">
              <tbody>
              <tr>
                <td>
                  <table class="table mb-0">
                    <tbody>
                    <tr>
                      <td>
                        <div class="img-block">
                          <div class="lawwa-table-wrap">
                            <div class="lawwa-align-wrap">
                              <img src="'.asset('images/productsimages/'.$value->product_thumbnail).'" alt="Cart">
                            </div>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="cart-info">
                          <h4><a href='.route('product-details',$value->id).'>'.$value->name.'</a></h4>
                          <h2> '.$value->sale_price.'<span> '.$value->price.'</span></h2>
                          <span class="link">'.round((($value->price  - $value->sale_price )*100) /$value->price).'  % OFF</span>
                          <ul class="right-list">
                            <li><a href='.route('product-details',$value->id).' class="link">Edit</a></li>
                            <li><a href="javascript:void(0)" class="link RemoveItemToProductCart" data-product_id="'.$value->pivot->product_id.'">Delete</a></li>
                          </ul>
                        </div>
                      </td>
                      <td align="right">
                        <div class="cart-right-info">
                          <h3>QTY : '.$value->pivot->quantity.'</h3>
                          <div class="price-info">
                            <span>Price</span>
                            <span>RM '.$products_total_price.'</span>
                          </div>
                        </div>
                      </td>
                    </tr>
                  </tbody></table>
                </td>
              </tr>
            </tbody></table>
          </div>
        </div>';
          }
          if($totalsaleprice<Setting()->ChargeCondition && $totalsaleprice>0 ) {
            $totalsaleprice =$totalsaleprice+ Setting()->ShippingCharges;
            $ShippingCharges=Setting()->ShippingCharges;
          }
          $totaldiscount=$totalprice-$totalsaleprice; 
          return response()->json(["message"=>"success","sub_total"=>$sub_total,"totalquantity"=> $totalquantity,"ShippingCharges"=> $ShippingCharges,"totaldiscount"=> $totaldiscount,"totalsaleprice"=> $totalsaleprice,"totalprice"=> $totalprice,'error'=>new \stdClass(),'data' =>$data], 200); 
    }
  
    public function GetUserAddress(){
      $address = UserAddress::where('user_id',Auth::id())->get();
      $data = '';
      foreach($address as $key => $value) {
        $data .='<div class="detail-info notification'.$value->id.'">
                    <label>
                      <input type="radio" value="'.$value->id.'"  name="selected_address" id="selected_address" class="selected_address">
                        <span class="radio-info"></span>
                    </label>
                      <ul>
                        <li>Name :<span>'.$value->Name.'</span></li>
                        <li>Phone :<span>'.$value->MobileNumber.'</span></li>
                        <li>Address :<span>'.$value->Address_line1.' , '.$value->GetCity->name.', '.$value->Zip_Postcode.' ('.$value->GetState->name.') , '.$value->GetCountry->name.' </span> <a href="javascript:void(0)" class="float-right link edit-address" data-model="UserAddress" data-Country='.$value->Country.'  data-State_Province_Region='.$value->State_Province_Region.'   data-id='.$value->id.' data-address_id='.$value->id.' data-town_city='.$value->Town_City.'  data-Address_line1='.$value->Address_line1.'  data-type='.$value->Type.' data-Zip_Postcode='.$value->Zip_Postcode.' data-name='.$value->Name.' data-MobileNumber='.$value->MobileNumber.'>Edit ?</a></li>
                      </ul>              
                  </div>';
                   
          }
          echo json_encode($data);
    }
    public function RemoveItemToProductCart(Request $Request)
    {
        try
        { 
           $product_id  = $Request->product_id;
           $ProductCart= ProductCart::where('product_id' ,$product_id)
                        ->where('user_id' , Auth::user()->id)
                        ->first();
        } 
        catch(ModelNotFoundException $e) 
        {
           return response()->json(["message"=>"error","code"=> "404",'error'=>"something went ot wrong",'data' => new \stdClass()], 404); 
        }
        if($ProductCart->delete())
        {
            return response()->json(["message"=>"product Remove successfully","code"=> "200",'error'=>new \stdClass(),'data' => new \stdClass()], 200); 
        }
    }

    public  function GetProductCartCount()
    {
      $ProductCartCount=ProductCart::where('user_id',Auth::id())->sum('quantity');
      echo json_encode($ProductCartCount);
    }

    public function AddToCartProduct(Request $Request,$quantity=1)
    {
      $quantity  = $Request->cartquantity;
      try
      { 
        if( $Request->has('id') ) {
          return redirect()->route('product-details', $Request->query('id'));
        } 
        $product_id  = $Request->product_id; 
        $type  = $Request->type;
        $size  = $Request->size;
        $color  = $Request->color;
        $Product     = Product::findorfail($product_id);
        $ProductCart = ProductCart::where('product_id' , $product_id)->where('user_id' , Auth::user()->id)->first();
      } 
      catch(ModelNotFoundException $e) 
      {
         return response()->json(["message"=>"error","code"=> "404",'error'=>"something went ot wrong....",'data' => new \stdClass()], 404); 
      }
      if($Product!="")
        {
          if($ProductCart!="")
            {
              if($type=="down") 
                {
                  $quantity= $ProductCart->quantity-$quantity;
                }
                elseif($type=="up")
                {
                  $quantity= $ProductCart->quantity+$quantity;    
                }
                else
                {
                 $quantity= $quantity;   
                }   
              ProductCart::where('product_id',$product_id)->update(['product_id' =>$product_id,'size'=>$size,'color'=>$color, 'user_id' => Auth::user()->id,'quantity'=>$quantity]);
                return response()->json(["message"=>"product quantity updated successfully","code"=> "200",'error'=>new \stdClass(),'data' => new \stdClass()], 200); 
            }
            else
            {
              ProductCart::create(['product_id' =>$product_id, 'user_id' => Auth::user()->id,'size'=>$size,'color'=>$color,'quantity'=>$quantity]);
              return response()->json(["message"=>"product add successfully","code"=> "200",'error'=>new \stdClass(),'data' => new \stdClass()], 200); 
            }
          return response()->json(["message"=>"error","code"=> "404",'error'=>"Product not found",'data' => new \stdClass()], 404); 
        } 
        else
        {
          return response()->json(["message"=>"error","code"=> "404",'error'=>"something went ot wrong",'data' => new \stdClass()], 404); 
        }

    }
    
}
