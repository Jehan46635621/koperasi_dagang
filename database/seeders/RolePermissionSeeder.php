<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // Member Management
            'view_members',
            'create_members',
            'edit_members',
            'delete_members',
            
            // Savings Management
            'view_savings_accounts',
            'create_savings_accounts',
            'edit_savings_accounts',
            'delete_savings_accounts',
            'process_savings_transactions',
            
            // Loan Management
            'view_loans',
            'create_loans',
            'edit_loans',
            'delete_loans',
            'approve_loans',
            'disburse_loans',
            'process_loan_payments',
            
            // Trading/Inventory
            'view_products',
            'create_products',
            'edit_products',
            'delete_products',
            'view_sales',
            'create_sales',
            'edit_sales',
            'delete_sales',
            'view_purchases',
            'create_purchases',
            'approve_purchases',
            
            // Accounting
            'view_journal_entries',
            'create_journal_entries',
            'edit_journal_entries',
            'delete_journal_entries',
            'post_journal_entries',
            'view_reports',
            'close_fiscal_period',
            
            // Settings
            'manage_settings',
            'manage_branches',
            'manage_users',
            'manage_roles',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(
                ['name' => $permission, 'guard_name' => 'web']
            );
        }

        // Create roles and assign permissions

        // 1. Super Admin - Full access
        $superAdmin = Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'web']);
        $superAdmin->givePermissionTo(Permission::all());

        // 2. Manager - Branch operations and approvals
        $manager = Role::firstOrCreate(['name' => 'manager', 'guard_name' => 'web']);
        $manager->givePermissionTo([
            'view_members', 'create_members', 'edit_members',
            'view_savings_accounts', 'view_loans', 'approve_loans', 'disburse_loans',
            'view_products', 'view_sales', 'view_purchases', 'approve_purchases',
            'view_journal_entries', 'view_reports',
            'manage_branches',
        ]);

        // 3. Teller - Transaction processing
        $teller = Role::firstOrCreate(['name' => 'teller', 'guard_name' => 'web']);
        $teller->givePermissionTo([
            'view_members',
            'view_savings_accounts', 'process_savings_transactions',
            'view_loans', 'process_loan_payments',
            'view_sales', 'create_sales',
        ]);

        // 4. Loan Officer - Loan processing
        $loanOfficer = Role::firstOrCreate(['name' => 'loan_officer', 'guard_name' => 'web']);
        $loanOfficer->givePermissionTo([
            'view_members', 'create_members', 'edit_members',
            'view_loans', 'create_loans', 'edit_loans',
            'view_savings_accounts',
        ]);

        // 5. Accountant - Accounting operations
        $accountant = Role::firstOrCreate(['name' => 'accountant', 'guard_name' => 'web']);
        $accountant->givePermissionTo([
            'view_journal_entries', 'create_journal_entries', 'edit_journal_entries', 'post_journal_entries',
            'view_reports', 'close_fiscal_period',
            'view_savings_accounts', 'view_loans', 'view_sales', 'view_purchases',
        ]);

        // 6. Warehouse Staff - Inventory management
        $warehouseStaff = Role::firstOrCreate(['name' => 'warehouse_staff', 'guard_name' => 'web']);
        $warehouseStaff->givePermissionTo([
            'view_products', 'create_products', 'edit_products',
            'view_purchases', 'create_purchases',
            'view_sales',
        ]);

        // 7. Member Services - Member registration and services
        $memberServices = Role::firstOrCreate(['name' => 'member_services', 'guard_name' => 'web']);
        $memberServices->givePermissionTo([
            'view_members', 'create_members', 'edit_members',
            'view_savings_accounts', 'create_savings_accounts',
            'view_loans',
        ]);

        // 8. Auditor - Read-only access
        $auditor = Role::firstOrCreate(['name' => 'auditor', 'guard_name' => 'web']);
        $auditor->givePermissionTo([
            'view_members',
            'view_savings_accounts',
            'view_loans',
            'view_products',
            'view_sales',
            'view_purchases',
            'view_journal_entries',
            'view_reports',
        ]);

        $this->command->info('Roles and permissions created successfully!');
    }
}

