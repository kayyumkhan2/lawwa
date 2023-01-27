<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TicketCategory;
class TicketCategoriesSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['name'=>'Order Related'],
            ['name'=>'Technical Support'],
            ['name'=>'Booking Related'],
            ['name'=>'Dispute & Complaint'],
            ['name'=>'Other'],
        ];
        TicketCategory::insert($data);
    }
}
