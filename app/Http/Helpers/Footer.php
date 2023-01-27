<?php
use App\Models\Address;
use App\Models\Email;
use App\Models\ContactNumber;
use App\Models\SocialLink;

function footer($type="contactnumbers"){     
	switch($type){      
	case "socialLinks":      
	 return $socialLinks = SocialLink::orderBy('id', 'ASC')->where('status','=','1')->get();     
	break;      
	case "addressess":      
	 return $addressess  = Address::orderBy('id', 'ASC')->where('status','=','1')->where('default_status','=','1')->get();      
	break;      
	case "emails":      
	 return $emails 	= Email::orderBy('id', 'ASC')->where('status','=','1')->where('default_status','=','1')->get();     
	break;      
	default:      
	 return $contactnumbers = ContactNumber::orderBy('id', 'ASC')->where('status','=','1')->where('default_status','=','1')->get();
	}             
}


