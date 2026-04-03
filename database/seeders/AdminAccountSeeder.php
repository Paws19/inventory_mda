<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\AdminAccount_model as AdminAccount;

class AdminAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        AdminAccount::create([
        'username' => 'admin.mda@edu.ph',
        'password' => Hash::make('ilovemdaforever123'),
    ]);

    }
}
