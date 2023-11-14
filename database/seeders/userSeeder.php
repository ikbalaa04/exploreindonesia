<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // add admin 
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('asddsa123'),
            'mobile_phone' => '08123123',
            'file' => null,
            'user_type' => 'admin',
            'address' => null,
            'email_verified_at' => Carbon::now(),
            'gender' => null,
            'birth_date' => null,
            'otp' => null,
            'google_id' => null,
            'sender_id' => null,
            'twitter' => null,
            'facebook' => null,
            'instagram' => null,
            'website' => null
        ]);
    }
}
