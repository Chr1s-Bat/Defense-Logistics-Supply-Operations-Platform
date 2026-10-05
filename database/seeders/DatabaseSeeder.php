<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Personnel;
use App\Models\LogisticsItem;
use App\Models\Operation;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Admin User
        $adminUser = User::create([
            'name' => 'Commander Reyes',
            'email' => 'admin@dlsop.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);
        Personnel::create([
            'user_id' => $adminUser->id,
            'rank' => 'General',
            'unit_code' => 'HQ-01',
            'clearance_level' => 'Top-Secret',
        ]);

        // 2. Create Officer User
        $officerUser = User::create([
            'name' => 'Lieutenant Santos',
            'email' => 'officer@dlsop.com',
            'password' => Hash::make('password123'),
            'role' => 'officer',
        ]);
        $personnel = Personnel::create([
            'user_id' => $officerUser->id,
            'rank' => 'Lieutenant',
            'unit_code' => 'REC-04',
            'clearance_level' => 'Confidential',
        ]);

        // 3. Create Logistics Items
        $items = [];
        $categories = ['Reconnaissance', 'Manufacturing', 'Trade'];
        for ($i = 1; $i <= 10; $i++) {
            $items[] = LogisticsItem::create([
                'name' => "Tactical Gear Unit #{$i}",
                'category' => $categories[array_rand($categories)],
                'stock_quantity' => rand(50, 500),
                'unit_cost' => rand(150, 5000) + 0.99,
            ]);
        }

        // 4. Create 20 Operations (Fulfills the 20+ records sample requirement)[cite: 3]
        $statuses = ['Pending', 'Active', 'Completed'];
        for ($i = 1; $i <= 20; $i++) {
            Operation::create([
                'operation_code' => 'OP-CODE-' . strtoupper(substr(md5(mt_rand()), 0, 6)),
                'personnel_id' => $personnel->id,
                'logistics_item_id' => $items[array_rand($items)]->id,
                'quantity_allocated' => rand(1, 25),
                'status' => $statuses[array_rand($statuses)],
                'mission_notes' => 'Routine deployment check for sector node alpha.',
            ]);
        }
    }
}
