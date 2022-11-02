<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $inputan['name'] = 'Utara';
        $inputan['email'] = 'utara@gmail.com';//ganti pake emailmu
        $inputan['password'] = Hash::make('123258');//passwordnya 123258
        $inputan['phone'] = '085852527575';
        $inputan['level'] = 'admin';//kita akan membuat akun atau users in dengan role admin
        User::create($inputan);

        $inputed['name'] = 'Kriza';
        $inputed['email'] = 'kriz4nafis@gmail.com';
        $inputed['password'] = Hash::make('12345678');
        $inputed['phone'] = '085852527575';
        $inputed['level'] = 'seller';
        User::create($inputed);
    }
}
