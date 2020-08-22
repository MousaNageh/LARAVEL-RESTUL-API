<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=User::create([
            "name"=>"mousa nageh" , 
            "email"=>"200moussa200@gmail.com" , 
            "password"=>Hash::make("mousamousa1234")
        ]) ;
        Auth::login($user);
    }
}
