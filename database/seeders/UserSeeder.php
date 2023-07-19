<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'Cynthia',
            'last_name' => 'Kiiru',
            'mobile' => '07000000000',
            'username' => 'cynthia',
            'email' => 'cynthia@gmail.com',
            'password' => Hash::make('12345678.'),
            'status' => 'activated',
        ]);

        // Get the "Administrator" role
        $adminRole = Role::where('name', 'Administrator')->first();

        // Assign the role to the user
        $user = User::where('email', 'cynthia@gmail.com')->first();
        $user->assignRole($adminRole);

        $faker = Faker::create();

        for ($i = 0; $i < 25; $i++) {
            $firstName = $faker->firstName;
            $lastName = $faker->lastName;
            $username = strtolower($firstName) . '.' . strtolower($lastName) . $i;
            $email = $faker->unique()->safeEmail;
            $password = Hash::make('12345678');
            $mobile = $faker->phoneNumber;
            $status = $faker->randomElement(['activated', 'inactive', 'suspended', 'locked']);
            $createdAt = $faker->dateTimeBetween('-1 year', 'now'); // Random date within the past year

            User::create([
                'first_name' => $firstName,
                'last_name' => $lastName,
                'username' => $username,
                'password' => $password,
                'email' => $email,
                'mobile' => $mobile,
                'status' => $status,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ]);
        }
        $userRole = Role::where('name', 'User')->first();
        $user->assignRole($userRole);
    }
}
