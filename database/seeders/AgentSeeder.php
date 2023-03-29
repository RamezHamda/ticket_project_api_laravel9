<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AgentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 5; $i++){
            User::create([
                'name' => 'agent'.$i,
                'email' => 'agent'.$i.'@gmail.com',
                'password' => bcrypt('123456'),
                'status' => 1,
                'type' => 1,
            ]);
        }
        
    }
}
