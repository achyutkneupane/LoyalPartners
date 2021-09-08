<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Container\Container;
use Faker\Generator;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Container::getInstance()->make(Generator::class);
        $director = Role::create(['name' => 'director']);
        $tenant = Role::create(['name' => 'tenant']);
        $household = Role::create(['name' => 'household_member']);
        $user = User::create([
            'name' => 'LoyalPartners Director',
            'email' => 'director@loyal.test',
            'password' => Hash::make('LoyalDirector'),
            'type' => 'director',
            'contact' => $faker->e164PhoneNumber(),
            'verified' => true,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
        $user->assignRole($director);
        for($i=0;$i<25;$i++) {
            $user = User::factory()->create([
                'email' => 'tenant'.$i.'@loyal.test',
                'name' => 'Loyal Tenant '.$i,
                'password' => Hash::make('LoyalTenant'),
                'verified' => true,
                'type' => 'tenant'
            ]);
            $user->assignRole($tenant);
        }
        $user = User::create([
            'name' => 'Sheldon Cooper',
            'email' => 'sheldoncooper@bigbang.theory',
            'password' => Hash::make('Ghost0vperditi0n'),
            'contact' => $faker->e164PhoneNumber(),
            'type' => 'tenant',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
        $user->assignRole($tenant);
        for($i=0;$i<25;$i++) {
            $user = User::factory()->create([
                'email' => 'household'.$i.'@loyal.test',
                'name' => 'Loyal Household Member '.$i,
                'password' => Hash::make('LoyalMember'),
                'verified' => true,
                'type' => 'household_member'
            ]);
            $user->assignRole($household);
        }
        $user = User::create([
            'name' => 'Chandler Bing',
            'email' => 'chandlerbing@frien.ds',
            'password' => Hash::make('Ghost0vperditi0n'),
            'contact' => $faker->e164PhoneNumber(),
            'type' => 'household_member',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
        $user->assignRole($household);
    }
}
