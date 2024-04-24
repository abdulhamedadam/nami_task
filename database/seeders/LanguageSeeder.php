<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'word' => 'add_task',
                'english' => 'Add Task',
                'arabic' => 'إضافة',
            ],
            [
                'id' => 2,
                'word' => 'back',
                'english' => 'Back',
                'arabic' => 'الرجوع',
            ],
            [
                'id' => 3,
                'word' => 'task_name',
                'english' => 'Task Name',
                'arabic' => 'إسم المهمة',
            ],
            [
                'id' => 4,
                'word' => 'descriptions',
                'english' => 'Descriptions',
                'arabic' => 'الوصف',
            ],
            [
                'id' => 5,
                'word' => 'SaveButton',
                'english' => 'SaveButton',
                'arabic' => 'الحفظ',
            ],
            [
                'id' => 6,
                'word' => 'reports_statistics',
                'english' => 'Reports Statistics',
                'arabic' => '', // Add Arabic translation here
            ],
            [
                'id' => 7,
                'word' => 'abdulhamed_&_mahmoud',
                'english' => 'Abdulhamed & Mahmoud',
                'arabic' => '', // Add Arabic translation here
            ],
            [
                'id' => 8,
                'word' => 'all_rights_reserved',
                'english' => 'All Rights Reserved',
                'arabic' => 'كل الحقوق محفوظة',
            ],
            [
                'id' => 9,
                'word' => 'm',
                'english' => 'M',
                'arabic' => 'م',
            ],
            [
                'id' => 10,
                'word' => 'sub_task_name',
                'english' => 'Sub Task Name',
                'arabic' => 'المهمة الفرعية',
            ],

            [
                'id' => 11,
                'word' => 'date',
                'english' => 'Date',
                'arabic' => 'التاريخ',
            ],
            [
                'id' => 12,
                'word' => 'time',
                'english' => 'Time',
                'arabic' => 'الوقت',
            ],
            [
                'id' => 13,
                'word' => 'action',
                'english' => 'Action',
                'arabic' => 'الإجراء',
            ],
            [
                'id' => 14,
                'word' => 'add_sub_task',
                'english' => 'Add Sub Task',
                'arabic' => 'إضافة مهمة فرعية',
            ],
            [
                'id' => 15,
                'word' => 'load_process',
                'english' => 'Load Process',
                'arabic' => 'جاري الحفظ',
            ],
            [
                'id' => 16,
                'word' => 'Tasks',
                'english' => 'Tasks',
                'arabic' => 'المهام',
            ],
            [
                'id' => 17,
                'word' => 'add_new_task',
                'english' => 'Add New Task',
                'arabic' => 'إضافة مهمة جديدة',
            ],
            [
                'id' => 18,
                'word' => 'description',
                'english' => 'Description',
                'arabic' => 'الوصف',
            ],
            [
                'id' => 19,
                'word' => 'sub_tasks_number',
                'english' => 'Sub Tasks Number',
                'arabic' => 'عدد المهام الفرعية',
            ],
            [
                'id' => 20,
                'word' => 'actions',
                'english' => 'Actions',
                'arabic' => 'الإجراء',
            ],

            [
                'id' => 21,
                'word' => 'edit_task',
                'english' => 'Edit Task',
                'arabic' => 'تعديل المهمة',
            ],
            [
                'id' => 22,
                'word' => 'added_successfully',
                'english' => 'Added Successfully',
                'arabic' => 'تمت الإضافة بنجاح',
            ],
            [
                'id' => 23,
                'word' => 'sub_tasks',
                'english' => 'Sub Tasks',
                'arabic' => 'المهام الفرعية',
            ],
            [
                'id' => 24,
                'word' => 'hash',
                'english' => 'Hash',
                'arabic' => 'م',
            ],
            [
                'id' => 25,
                'word' => 'sub_task',
                'english' => 'Sub Task',
                'arabic' => 'المهمة الفرعية',
            ],
            [
                'id' => 26,
                'word' => 'status',
                'english' => 'Status',
                'arabic' => 'الحالة',
            ],
            [
                'id' => 27,
                'word' => 'task_details',
                'english' => 'Task Details',
                'arabic' => 'تفاصيل المهمة',
            ],
            [
                'id' => 28,
                'word' => 'notfinished',
                'english' => 'Notfinished',
                'arabic' => 'غير منتهية',
            ],
            [
                'id' => 29,
                'word' => 'Are you sure to change status!?',
                'english' => 'Are You Sure To Change Status!?',
                'arabic' => 'هل تريد تغير الحالة؟',
            ],
            [
                'id' => 30,
                'word' => 'change_type_msg',
                'english' => 'Change Type Msg',
                'arabic' => 'رسالة تغيير النوع',
            ],



        ];
        foreach ($data as $row) {
            DB::table('languages')->insert([
                'id' => $row['id'],
                'word' => $row['word'],
                'english' => $row['english'],
                'arabic' => $row['arabic'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
