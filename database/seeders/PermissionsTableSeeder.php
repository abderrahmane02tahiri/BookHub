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
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 18,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 19,
                'title' => 'task_management_access',
            ],
            [
                'id'    => 20,
                'title' => 'task_status_create',
            ],
            [
                'id'    => 21,
                'title' => 'task_status_edit',
            ],
            [
                'id'    => 22,
                'title' => 'task_status_show',
            ],
            [
                'id'    => 23,
                'title' => 'task_status_delete',
            ],
            [
                'id'    => 24,
                'title' => 'task_status_access',
            ],
            [
                'id'    => 25,
                'title' => 'task_tag_create',
            ],
            [
                'id'    => 26,
                'title' => 'task_tag_edit',
            ],
            [
                'id'    => 27,
                'title' => 'task_tag_show',
            ],
            [
                'id'    => 28,
                'title' => 'task_tag_delete',
            ],
            [
                'id'    => 29,
                'title' => 'task_tag_access',
            ],
            [
                'id'    => 30,
                'title' => 'task_create',
            ],
            [
                'id'    => 31,
                'title' => 'task_edit',
            ],
            [
                'id'    => 32,
                'title' => 'task_show',
            ],
            [
                'id'    => 33,
                'title' => 'task_delete',
            ],
            [
                'id'    => 34,
                'title' => 'task_access',
            ],
            [
                'id'    => 35,
                'title' => 'tasks_calendar_access',
            ],
            [
                'id'    => 36,
                'title' => 'expense_management_access',
            ],
            [
                'id'    => 37,
                'title' => 'expense_category_create',
            ],
            [
                'id'    => 38,
                'title' => 'expense_category_edit',
            ],
            [
                'id'    => 39,
                'title' => 'expense_category_show',
            ],
            [
                'id'    => 40,
                'title' => 'expense_category_delete',
            ],
            [
                'id'    => 41,
                'title' => 'expense_category_access',
            ],
            [
                'id'    => 42,
                'title' => 'income_category_create',
            ],
            [
                'id'    => 43,
                'title' => 'income_category_edit',
            ],
            [
                'id'    => 44,
                'title' => 'income_category_show',
            ],
            [
                'id'    => 45,
                'title' => 'income_category_delete',
            ],
            [
                'id'    => 46,
                'title' => 'income_category_access',
            ],
            [
                'id'    => 47,
                'title' => 'expense_create',
            ],
            [
                'id'    => 48,
                'title' => 'expense_edit',
            ],
            [
                'id'    => 49,
                'title' => 'expense_show',
            ],
            [
                'id'    => 50,
                'title' => 'expense_delete',
            ],
            [
                'id'    => 51,
                'title' => 'expense_access',
            ],
            [
                'id'    => 52,
                'title' => 'income_create',
            ],
            [
                'id'    => 53,
                'title' => 'income_edit',
            ],
            [
                'id'    => 54,
                'title' => 'income_show',
            ],
            [
                'id'    => 55,
                'title' => 'income_delete',
            ],
            [
                'id'    => 56,
                'title' => 'income_access',
            ],
            [
                'id'    => 57,
                'title' => 'expense_report_create',
            ],
            [
                'id'    => 58,
                'title' => 'expense_report_edit',
            ],
            [
                'id'    => 59,
                'title' => 'expense_report_show',
            ],
            [
                'id'    => 60,
                'title' => 'expense_report_delete',
            ],
            [
                'id'    => 61,
                'title' => 'expense_report_access',
            ],
            [
                'id'    => 62,
                'title' => 'time_management_access',
            ],
            [
                'id'    => 63,
                'title' => 'time_work_type_create',
            ],
            [
                'id'    => 64,
                'title' => 'time_work_type_edit',
            ],
            [
                'id'    => 65,
                'title' => 'time_work_type_show',
            ],
            [
                'id'    => 66,
                'title' => 'time_work_type_delete',
            ],
            [
                'id'    => 67,
                'title' => 'time_work_type_access',
            ],
            [
                'id'    => 68,
                'title' => 'time_project_create',
            ],
            [
                'id'    => 69,
                'title' => 'time_project_edit',
            ],
            [
                'id'    => 70,
                'title' => 'time_project_show',
            ],
            [
                'id'    => 71,
                'title' => 'time_project_delete',
            ],
            [
                'id'    => 72,
                'title' => 'time_project_access',
            ],
            [
                'id'    => 73,
                'title' => 'time_entry_create',
            ],
            [
                'id'    => 74,
                'title' => 'time_entry_edit',
            ],
            [
                'id'    => 75,
                'title' => 'time_entry_show',
            ],
            [
                'id'    => 76,
                'title' => 'time_entry_delete',
            ],
            [
                'id'    => 77,
                'title' => 'time_entry_access',
            ],
            [
                'id'    => 78,
                'title' => 'time_report_create',
            ],
            [
                'id'    => 79,
                'title' => 'time_report_edit',
            ],
            [
                'id'    => 80,
                'title' => 'time_report_show',
            ],
            [
                'id'    => 81,
                'title' => 'time_report_delete',
            ],
            [
                'id'    => 82,
                'title' => 'time_report_access',
            ],
            [
                'id'    => 83,
                'title' => 'book_management_access',
            ],
            [
                'id'    => 84,
                'title' => 'book_create',
            ],
            [
                'id'    => 85,
                'title' => 'book_edit',
            ],
            [
                'id'    => 86,
                'title' => 'book_show',
            ],
            [
                'id'    => 87,
                'title' => 'book_delete',
            ],
            [
                'id'    => 88,
                'title' => 'book_access',
            ],
            [
                'id'    => 89,
                'title' => 'book_genres_and_category_create',
            ],
            [
                'id'    => 90,
                'title' => 'book_genres_and_category_edit',
            ],
            [
                'id'    => 91,
                'title' => 'book_genres_and_category_show',
            ],
            [
                'id'    => 92,
                'title' => 'book_genres_and_category_delete',
            ],
            [
                'id'    => 93,
                'title' => 'book_genres_and_category_access',
            ],
            [
                'id'    => 94,
                'title' => 'status_create',
            ],
            [
                'id'    => 95,
                'title' => 'status_edit',
            ],
            [
                'id'    => 96,
                'title' => 'status_show',
            ],
            [
                'id'    => 97,
                'title' => 'status_delete',
            ],
            [
                'id'    => 98,
                'title' => 'status_access',
            ],
            [
                'id'    => 99,
                'title' => 'rating_create',
            ],
            [
                'id'    => 100,
                'title' => 'rating_edit',
            ],
            [
                'id'    => 101,
                'title' => 'rating_show',
            ],
            [
                'id'    => 102,
                'title' => 'rating_delete',
            ],
            [
                'id'    => 103,
                'title' => 'rating_access',
            ],
            [
                'id'    => 104,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
