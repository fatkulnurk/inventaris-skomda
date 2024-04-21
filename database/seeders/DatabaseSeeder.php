<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Enums\Users\UserRole;
use App\Models\Building;
use App\Models\Category;
use App\Models\Inventory;
use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         $user = User::factory()->create([
             'name' => 'Admin',
             'email' => 'admin@dibumi.com',
             'password' => Hash::make('password'),
             'role' => UserRole::ADMIN->value,
         ]);
         $this->command->info('Delay 3 second');
         sleep(3);

         foreach (UserRole::cases() as $role) {
             User::factory(10)->create([
                 'role' => $role->value
             ]);
         }

         $this->call([
             CategorySeeder::class,
             RoomSeeder::class,
             InvestorySeeder::class,
         ]);

//         Storage::deleteDirectory('public/inventories');
//         Storage::makeDirectory('public/inventories');
//
//         for ($i = 0; $i < 15; $i++) {
//             Inventory::factory()->create();
//         }
    }
}
