<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[
            'description' =>"A website that allows people to buy and sell physical goods,
             services, and digital products over the internet rather than at a brick-and-mortar location.
            Through an e-commerce website, a business can process orders, accept payments
            ,manage shipping and logistics, and provide customer service.",
            'logo'=>'logo.jpg',
            'address'=>"Cairo - Egypt",
            'email'=>"eComerceShop@gmail.com",
            'phone'=>"01000966960",
        ];
        Setting::create($data);
    }
}
