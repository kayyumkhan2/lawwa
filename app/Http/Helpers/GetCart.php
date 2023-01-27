<?php
use App\Models\{Service,ServiceCart,ProductCart};
        
function GetServiceCart()
{
  return $ServiceCart=ServiceCart::where('user_id',Auth::id())->get();
}

