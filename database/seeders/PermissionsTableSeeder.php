<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'fleet_data_create',
            ],
            [
                'id'    => 18,
                'title' => 'fleet_data_edit',
            ],
            [
                'id'    => 19,
                'title' => 'fleet_data_show',
            ],
            [
                'id'    => 20,
                'title' => 'fleet_data_delete',
            ],
            [
                'id'    => 21,
                'title' => 'fleet_data_access',
            ],
            [
                'id'    => 22,
                'title' => 'report_create',
            ],
            [
                'id'    => 23,
                'title' => 'report_edit',
            ],
            [
                'id'    => 24,
                'title' => 'report_show',
            ],
            [
                'id'    => 25,
                'title' => 'report_delete',
            ],
            [
                'id'    => 26,
                'title' => 'report_access',
            ],
            [
                'id'    => 27,
                'title' => 'money_received_create',
            ],
            [
                'id'    => 28,
                'title' => 'money_received_edit',
            ],
            [
                'id'    => 29,
                'title' => 'money_received_show',
            ],
            [
                'id'    => 30,
                'title' => 'money_received_delete',
            ],
            [
                'id'    => 31,
                'title' => 'money_received_access',
            ],
            [
                'id'    => 32,
                'title' => 'float_management_create',
            ],
            [
                'id'    => 33,
                'title' => 'float_management_edit',
            ],
            [
                'id'    => 34,
                'title' => 'float_management_show',
            ],
            [
                'id'    => 35,
                'title' => 'float_management_delete',
            ],
            [
                'id'    => 36,
                'title' => 'float_management_access',
            ],
            [
                'id'    => 37,
                'title' => 'send_float_create',
            ],
            [
                'id'    => 38,
                'title' => 'send_float_edit',
            ],
            [
                'id'    => 39,
                'title' => 'send_float_show',
            ],
            [
                'id'    => 40,
                'title' => 'send_float_delete',
            ],
            [
                'id'    => 41,
                'title' => 'send_float_access',
            ],
            [
                'id'    => 42,
                'title' => 'expense_category_create',
            ],
            [
                'id'    => 43,
                'title' => 'expense_category_edit',
            ],
            [
                'id'    => 44,
                'title' => 'expense_category_show',
            ],
            [
                'id'    => 45,
                'title' => 'expense_category_delete',
            ],
            [
                'id'    => 46,
                'title' => 'expense_category_access',
            ],
            [
                'id'    => 47,
                'title' => 'other_expense_create',
            ],
            [
                'id'    => 48,
                'title' => 'other_expense_edit',
            ],
            [
                'id'    => 49,
                'title' => 'other_expense_show',
            ],
            [
                'id'    => 50,
                'title' => 'other_expense_delete',
            ],
            [
                'id'    => 51,
                'title' => 'other_expense_access',
            ],
            [
                'id'    => 52,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
