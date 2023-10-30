<?php

namespace Database\Seeders;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Spatie\Permission\Exceptions\PermissionDoesNotExist;
use Spatie\Permission\Exceptions\RoleDoesNotExist;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = config('permissions');
        $roles = config('roles');

        Model::unguard();

        foreach ($permissions as $group_key => $permission_group) {
            foreach ($permission_group as $permission) {
                try {
                    Permission::findByName($permission);
                } catch (Exception $exception) {
                    if ($exception instanceof PermissionDoesNotExist){
                        Permission::create([
                            'name' => $permission,
                            'group' => $group_key
                        ]);
                    }
                }
            }
        }

        foreach ($roles as $roleData){
            try{
                $role = Role::findByName($roleData['name']);
            }catch (Exception $exception){
                $role = Role::create(collect($roleData)->except(['permissions', 'revoke_permissions'])->toArray());
            } finally {
                $role->givePermissionTo($roleData['permissions']);
                $role->revokePermissionTo($roleData['revoke_permissions']);
            }
        }

        $role = Role::where('name', 'super_admin')->first();
        $role->givePermissionTo(Permission::all());
    }
}
