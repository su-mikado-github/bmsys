<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class InitialDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'email' => 'shuji.ushiyama@gmail.com',
            'employee_no' => 0,
            'password' => Hash::make('password'),
            'last_name' => 'システム',
            'first_name' => '管理者',
            'last_name_hirakana' => 'しすてむ',
            'first_name_hirakana' => 'かんりしゃ',
            'hire_date' => '2024-10-01',
            'first_paid_grant_date' => '2024-10-01',
            'reminder_token' => Hash::make(Str::random(16)),
            'create_tm' => 0,
            'create_id' => 0,
            'update_tm' => 0,
            'update_id' => 0,
            'is_deleted' => 0,
        ]);
    }
}
