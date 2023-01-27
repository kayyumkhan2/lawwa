<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;
class DefaultSettingsSeeder extends Seeder
{
    public function run()
    {
        Setting::create(['ShippingCharges' => '1','BeauticianCommission' => '1','ChargeCondition' => '1']);
    }
}
