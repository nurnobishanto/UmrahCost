<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\PermissionGroup;
use App\Models\Role;
use App\Models\RoleHasPermission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->name = 'Admin';
        $role->slug = 'admin';
        $role->save();

        $role = new Role();
        $role->name = 'CRM';
        $role->slug = 'crm';
        $role->save();


        $permissionGroup = new PermissionGroup();
        $permissionGroup->name = 'Client Source';
        $permissionGroup->save();
        $permission = Permission::create(['name' => 'Client Source List', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Client Source Create', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Client Source Edit', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Client Source View', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Client Source Delete', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        
        $permissionGroup = new PermissionGroup();
        $permissionGroup->name = 'Client Feedback';
        $permissionGroup->save();
        $permission = Permission::create(['name' => 'Client Feedback List', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Client Feedback Create', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Client Feedback Edit', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Client Feedback View', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Client Feedback Delete', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        
        $permissionGroup = new PermissionGroup();
        $permissionGroup->name = 'Query About';
        $permissionGroup->save();
        $permission = Permission::create(['name' => 'Query About List', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Query About Create', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Query About Edit', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Query About View', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Query About Delete', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        
        $permissionGroup = new PermissionGroup();
        $permissionGroup->name = 'Client Status';
        $permissionGroup->save();
        $permission = Permission::create(['name' => 'Client Status List', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Client Status Create', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Client Status Edit', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Client Status View', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Client Status Delete', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        
        $permissionGroup = new PermissionGroup();
        $permissionGroup->name = 'Status';
        $permissionGroup->save();
        $permission = Permission::create(['name' => 'Status List', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Status Create', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Status Edit', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Status View', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Status Delete', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        
        $permissionGroup = new PermissionGroup();
        $permissionGroup->name = 'Currency';
        $permissionGroup->save();
        $permission = Permission::create(['name' => 'Currency List', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Currency Create', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Currency Edit', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Currency View', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Currency Delete', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        
        $permissionGroup = new PermissionGroup();
        $permissionGroup->name = 'Package';
        $permissionGroup->save();
        $permission = Permission::create(['name' => 'Package List', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Package Create', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Package Edit', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Package View', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Package Delete', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        
        $permissionGroup = new PermissionGroup();
        $permissionGroup->name = 'Package Type';
        $permissionGroup->save();
        $permission = Permission::create(['name' => 'Package Type List', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Package Type Create', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Package Type Edit', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Package Type View', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Package Type Delete', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        
        $permissionGroup = new PermissionGroup();
        $permissionGroup->name = 'Hotel';
        $permissionGroup->save();
        $permission = Permission::create(['name' => 'Hotel List', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Hotel Create', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Hotel Edit', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Hotel View', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Hotel Delete', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);

        $permissionGroup = new PermissionGroup();
        $permissionGroup->name = 'Room Type';
        $permissionGroup->save();
        $permission = Permission::create(['name' => 'Room Type List', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Room Type Create', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Room Type Edit', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Room Type View', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Room Type Delete', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);

        $permissionGroup = new PermissionGroup();
        $permissionGroup->name = 'Airline';
        $permissionGroup->save();
        $permission = Permission::create(['name' => 'Airline List', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Airline Create', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Airline Edit', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Airline View', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Airline Delete', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        
        $permissionGroup = new PermissionGroup();
        $permissionGroup->name = 'Location';
        $permissionGroup->save();
        $permission = Permission::create(['name' => 'Location List', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Location Create', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Location Edit', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Location View', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Location Delete', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        
        $permissionGroup = new PermissionGroup();
        $permissionGroup->name = 'Transport';
        $permissionGroup->save();
        $permission = Permission::create(['name' => 'Transport List', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Transport Create', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Transport Edit', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Transport View', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Transport Delete', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        
        $permissionGroup = new PermissionGroup();
        $permissionGroup->name = 'Guide';
        $permissionGroup->save();
        $permission = Permission::create(['name' => 'Guide List', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Guide Create', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Guide Edit', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Guide View', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Guide Delete', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        
        $permissionGroup = new PermissionGroup();
        $permissionGroup->name = 'Sightseeing';
        $permissionGroup->save();
        $permission = Permission::create(['name' => 'Sightseeing List', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Sightseeing Create', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Sightseeing Edit', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Sightseeing View', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Sightseeing Delete', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        
        $permissionGroup = new PermissionGroup();
        $permissionGroup->name = 'Client';
        $permissionGroup->save();
        $permission = Permission::create(['name' => 'Client List', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Client Create', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Client Edit', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Client View', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Client Delete', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Client To Package Create', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);

        $permissionGroup = new PermissionGroup();
        $permissionGroup->name = 'CRM';
        $permissionGroup->save();
        $permission = Permission::create(['name' => 'CRM List', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'CRM Create', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'CRM Edit', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'CRM View', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'CRM Delete', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        
        $permissionGroup = new PermissionGroup();
        $permissionGroup->name = 'Custom Package';
        $permissionGroup->save();
        $permission = Permission::create(['name' => 'Custom Package List', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Custom Package Create', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Custom Package Edit', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Custom Package View', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Custom Package Delete', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);

        $permissionGroup = new PermissionGroup();
        $permissionGroup->name = 'Service Voucher';
        $permissionGroup->save();
        $permission = Permission::create(['name' => 'Service Voucher List', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Service Voucher Create', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Service Voucher Edit', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Service Voucher View', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Service Voucher Delete', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        
        $permissionGroup = new PermissionGroup();
        $permissionGroup->name = 'Service Voucher Setting';
        $permissionGroup->save();
        $permission = Permission::create(['name' => 'Service Voucher Setting List', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Service Voucher Setting Create', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Service Voucher Setting Edit', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Service Voucher Setting View', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Service Voucher Setting Delete', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        
        $permissionGroup = new PermissionGroup();
        $permissionGroup->name = 'Role Permission';
        $permissionGroup->save();
        $permission = Permission::create(['name' => 'Role List', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        $permission = Permission::create(['name' => 'Role Permission Assign', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
        
        $permissionGroup = new PermissionGroup();
        $permissionGroup->name = 'Setting';
        $permissionGroup->save();
        $permission = Permission::create(['name' => 'Application Information Update', 'permission_group_id' => $permissionGroup->id]);
        $roleHasPermission = RoleHasPermission::create(['role_id' =>1,'permission_id'=> $permission->id]);
    }
}
