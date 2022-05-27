<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class Settings extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    \App\Models\Setting::create([
        'site_name'=>"Laravel's Blog",
        'address'=>'India',
        'contact_number'=>'+91-987654321',
        'contact_email'=>'default@gmail.com'
    ]);
}
}
