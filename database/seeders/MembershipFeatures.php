<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\MembershipFeature;
class MembershipFeatures extends Seeder
{
    public function run()
    {
        $data = [
            ['name'=>'Lawwa.Asia Welcome Kit'],
            ['name'=>'Free 1 Main Service (Classic Massage)'],
            ['name'=>'Enjoy our special promotion exclusive'],
        ];
        MembershipFeature::insert($data);
    }
}
