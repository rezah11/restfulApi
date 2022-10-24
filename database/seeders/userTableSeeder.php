<?php

namespace Database\Seeders;

use App\Models\User;
//use Illuminate\Database\Eloquent\Factories\HasFactory as fake;
//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class userTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('restful_api.users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        User::factory()->count(20)->create();
    }




}
