<?php
// database/seeders/RolesAndPermissionsSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        
        // ==================== ADMIN PERMISSIONS ====================
        // Based on ADMIN-01 to ADMIN-11 from SRS

        // Dashboard & Analytics (ADMIN-09, ADMIN-10)
        $adminPermissions = [
            // Dashboard permissions
            'view dashboard',
            'view statistics',

            // Project Management (ADMIN-02, ADMIN-03)
            'view projects',
            'create projects',
            'edit projects',
            'delete projects',
            'manage project images',
            'toggle project status',

            // Content Management (ADMIN-02)
            'view faqs',
            'create faqs',
            'edit faqs',
            'delete faqs',
            'view about us',
            'edit about us',

            // Marketing Campaigns (ADMIN-04)
            'view campaigns',
            'create campaigns',
            'edit campaigns',
            'delete campaigns',


            // Investor Management (ADMIN-05)
            'view investors',
            'edit investors',
            'toggle investor status',
            'export investors',

            // Inquiry Management (ADMIN-06)
            'view inquiries',
            'update inquiry status',
            'add inquiry notes',
            'filter inquiries',

            // Booking Management (ADMIN-07)
            'view bookings',
            'update booking status',
            'add booking notes',
            'filter bookings',

            // Inquiry Categories
            'view inquiry categories',
            'create inquiry categories',
            'edit inquiry categories',
            'delete inquiry categories',
            'toggle category status',

            // Notifications (ADMIN-08)
            'view notifications',
            'mark notifications read',
            'receive instant notifications',

            // Reports (ADMIN-10)
            'view source reports',
            'view utm reports',
            'export reports',

            // Lead Hub
            'view leads',
            'create leads',
            'edit leads',
            'delete leads',
            'assign leads',
            'update lead status',
            'view lead timeline',

            // Settings (ADMIN-11)
            'view settings',
            'edit settings',
            'manage company info',
            'manage social links',
            'manage page content',
        ];

        // ==================== CUSTOMER PERMISSIONS ====================
        // Based on APP-01 to APP-07 from your SRS
        $customerPermissions = [
            // Portfolio viewing (APP-01)
            'view projects',
            'view project details',

            // Account management (APP-02, APP-05)
            'register account',
            'login',
            'view own profile',
            'edit own profile',

            // Inquiries (APP-03)
            'create inquiries',
            'view own inquiries',

            // Bookings (APP-04)
            'create bookings',
            'view own bookings',
            'cancel own bookings',

            // Notifications (APP-07)
            'receive push notifications',
            'view own notifications',
        ];

        // Create all permissions
        foreach (array_merge($adminPermissions, $customerPermissions) as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // Create API guard permissions for mobile access
        foreach ($customerPermissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'api']);
        }

        // ==================== CREATE ROLES ====================

        // Admin Role - Full access to admin panel
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $adminRole->syncPermissions($adminPermissions);

        // Also give admin access to customer permissions (for testing/fallback)
        $adminRole->givePermissionTo($customerPermissions);

        // Customer Role - For mobile app users
        $customerRole = Role::firstOrCreate(['name' => 'customer', 'guard_name' => 'api']);
        $customerRole->syncPermissions($customerPermissions);

        // Also create web guard customer role for any web-based customer access
        $customerWebRole = Role::firstOrCreate(['name' => 'customer', 'guard_name' => 'web']);
        $customerWebRole->syncPermissions($customerPermissions);

        // ==================== ASSIGN ROLES TO EXISTING USERS ====================

        // Assign admin role to all users with user_type = 'admin'
        $adminUsers = User::where('user_type', 'admin')->get();
        foreach ($adminUsers as $user) {
            $user->assignRole('admin');
        }

        // Assign customer role to all users with user_type = 'customer'
        $customerUsers = User::where('user_type', 'customer')->get();
        foreach ($customerUsers as $user) {
            // Assign for both guards
            $user->assignRole('customer');
        }

        $this->command->info('Roles and permissions seeded successfully!');
    }
}
