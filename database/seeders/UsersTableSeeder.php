<?php

namespace Database\Seeders;

use App\Modules\Authentication\Domain\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->users() as $userData){
            $user = User::where('email', $userData['email'])->first();
            if (!$user){
                $user = User::create([
                    'name'     => $userData['name'],
                    'email'    => $userData['email'],
                    'is_active'    => $userData['is_active'],
                    'user_type_id'    => $userData['user_type_id'],
                    'password' => $userData['password'],
                    'email_verified_at' => $userData['email_verified_at'],
                ]);
            }
            $user->assignRole($userData['role']);
            $user->syncPermissions(Permission::all());
        }
    }

    /**
     * The default admin users.
     *
     * @return array
     */
    private function users(): array
    {
        return [
            [
                'name' => 'Mohamed Swilam',
                'email' => 'mohamed_swilam@hotmail.com',
                'is_active' => 1,
                'user_type_id' => 1,
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
                'role' => 'super_admin'
            ],
            [
                'name' => 'Normal User',
                'email' => 'normal-user@test.com',
                'is_active' => 1,
                'user_type_id' => 1,
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
                'role' => 'shopper'
            ],
            [
                'name' => 'Silver User',
                'email' => 'silver-user@test.com',
                'is_active' => 1,
                'user_type_id' => 2,
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
                'role' => 'shopper'
            ],
            [
                'name' => 'Gold User',
                'email' => 'gold-user@test.com',
                'is_active' => 1,
                'user_type_id' => 3,
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
                'role' => 'shopper'
            ],
        ];
    }
}
