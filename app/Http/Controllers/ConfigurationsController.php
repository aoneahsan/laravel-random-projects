<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class ConfigurationsController extends Controller
{
    public function site_setup(){

        //add default plans to site
        DB::table("plans")->insert([
            [
                "name" => "pro",
                "sites" => "20 domains",
                "price" => 9.99,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now()
            ],
            [
                "name" => "premium",
                "sites" => "unlimited domains",
                "price" => 19.99,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now()
            ],
        ]);

        //add default domains categories
        DB::table("categories")->insert([
            [
                "title" => "For Sale",
                "slug" => "for-sale",
                'description' => null,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now()
            ],
            [
                "title" => "For Rent",
                "slug" => "for-rent",
                'description' => null,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now()
            ],
        ]);

        $admin_role = Role::create(['name' => 'admin']);
        $prospect_role = Role::create(['name' => 'prospect']);

        //admin role permissions
        $view_users_p = Permission::create(['name' => 'can_view_users']);
        $create_users_p = Permission::create(['name' => 'can_create_users']);
        $edit_users_p = Permission::create(['name' => 'can_edit_users']);
        $delete_users_p = Permission::create(['name' => 'can_delete_users']);
        $view_all_templates_p = Permission::create(['name' => 'can_view_all_templates']);
        $site_settings_p = Permission::create(['name' => 'site_settings']);
        $view_admin_dashboard_p = Permission::create(['name' => 'can_view_admin_dashboard']);

        //prospect role permissions
        $view_dashboard_p = Permission::create(['name' => 'can_view_dashboard']);
        $view_his_templates_p = Permission::create(['name' => 'can_view_his_templates']);
        $create_templates_p = Permission::create(['name' => 'can_create_templates']);
        $edit_templates_p = Permission::create(['name' => 'can_edit_templates']);
        $delete_templates_p = Permission::create(['name' => 'can_delete_templates']);
        $profile_settings_p = Permission::create(['name' => 'can_view_profile_settings']);
        $purchase_templates_p = Permission::create(['name' => 'can_purchase_templates']);

        //assign permissions to admin role
        $admin_role->givePermissionTo($view_users_p);
        $admin_role->givePermissionTo($create_users_p);
        $admin_role->givePermissionTo($edit_users_p);
        $admin_role->givePermissionTo($delete_users_p);
        $admin_role->givePermissionTo($view_all_templates_p);
        $admin_role->givePermissionTo($site_settings_p);
        $admin_role->givePermissionTo($view_admin_dashboard_p);

        //assign permissions to prospect role
        $prospect_role->givePermissionTo($view_dashboard_p);
        $prospect_role->givePermissionTo($view_his_templates_p);
        $prospect_role->givePermissionTo($create_templates_p);
        $prospect_role->givePermissionTo($edit_templates_p);
        $prospect_role->givePermissionTo($delete_templates_p);
        $prospect_role->givePermissionTo($purchase_templates_p);
        $prospect_role->givePermissionTo($profile_settings_p);


        //create admin user and assign admin role to it
        $newUser =  User::create([
            'name' => 'Admin',
            'email' => 'admin@domain.com',
            'password' => Hash::make('freeb0rd'),
        ]);

        //assign a default role as 'prospect' to all newly signed up users
        $newUser->assignRole('admin');

        return 'Site configurations are done!';
    }
    
}
