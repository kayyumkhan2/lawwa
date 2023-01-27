<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
class PermissionTableSeeder extends Seeder
{
    public function run()
    {  
      $permissions = array (
             'Bookings'  => array("bookings-list","bookings-show","bookings-assign"),
             'Orders'  => array("orders-list","orders-show","orders-status-change"),
             'Mail-Templates'  => array("Mail-Templates-list","Mail-Templates-show","Mail-Templates-edit"),
             'Queries'  => array("queries-list","queries-show","queries-status-change"),
             'Feedbacks'  => array("Feedbacks-list","Feedbacks-show"),
             'Pages'  => array("Pages-list","Pages-show","Pages-edit"),
             'Tickets'  => array("Tickets-close","Tickets-show","Tickets-comments","Tickets-list"),
             'Notifications'  => array("Notifications-show","Notifications-edit","Notifications-create"),
             'Settings'  => array("Notifications-list","Notifications-delete"),
             'Courses'  => array("Courses-list"),
             'Payments'  => array("Payments-list"),
             'Certificates'  => array("Certificates-list","Certificates-update-change"),
             'Recruitment Applies'  => array("recruitmentapplies-list","recruitmentapplies-show"),
             'Roles'  => array("role-list","role-create","role-edit","role-delete","role-show"),
             'Banners'=> array("banners-list","banners-create","banners-edit","banners-delete","banners-show"),
             'Users'=> array("user-list","user-create","user-edit","user-delete","user-show"),
             'Products'=> array("product-list","product-create","product-edit","product-delete","product-show"),
             'Membership-plan'=> array("membershipplan-list","membershipplan-create","membershipplan-edit","membershipplan-delete","membershipplan-show"),
             'Category'=> array("categories-list","categories-create","categories-edit","categories-delete","categories-show"),
             'Services'=> array("service-list","service-create","service-edit","service-delete","service-show"),
             'Social-Links'=> array("sociallinks-list","sociallinks-create","sociallinks-edit","sociallinks-delete","sociallinks-show"),
             'Dashboard'=> array("Beauticians","Customers","Membership Customers","Total Orders","Total Products","Total Bookings","Booking Revenue","Order Revenue","Certification","Course Revenue","Membership Revenue"),
            );
        foreach ($permissions as $key => $value) {
            foreach ($value as $permission) {
                Permission::create(['name' => $permission,'permission_for' => $key]);
            }
        }
    }
}
