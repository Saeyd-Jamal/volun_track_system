<?php

namespace Database\Seeders;

use App\Models\Constant;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Create Admin User
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password'  => 'admin',
            'last_activity'  => now(),
            'avatar'  => null,
            'role'  =>  'admin',
        ]);

        $constants = [
            'cities' => [
                'غزة',
                'خانيونس',
                'رفح',
                'دير البلح',
                'جباليا',
                'بيت لاهيا',
                'بيت حانون',
                'النصيرات',
                'المغازي',
                'البريج',
            ],

            'universities' => [
                'الجامعة الإسلامية',
                'جامعة الأزهر',
                'جامعة الأقصى',
                'جامعة فلسطين',
                'جامعة الأمة',
                'جامعة غزة',
                'القدس المفتوحة',
            ],

            'volunteer_places' => [
                'مستشفى الشفاء',
                'مستشفى ناصر',
                'المستشفى الأوروبي',
                'المستشفى الإندونيسي',
                'جمعية الهلال الأحمر',
                'مركز الصحة النفسية',
                'بنك الدم المركزي',
                'مركز تأهيل المعاقين',
                'وزارة الشؤون الاجتماعية',
                'الدفاع المدني',
                'المراكز المجتمعية',
            ],

            'skills' => [
                'التواصل',
                'العمل الجماعي',
                'الكتابة',
            ],
        ];

        foreach ($constants as $key => $value) {
            Constant::create([
                'key' => $key,
                'value' => json_encode($value),
            ]);
        }

    }
}
