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
            'username'  => 'admin',
            'last_activity'  => now(),
            'avatar'  => null,
            'super_admin'  => 1,
        ]);

        $constants = [
            'cities' => [
                'gaza' => 'غزة',
                'khan_younis' => 'خانيونس',
                'rafah' => 'رفح',
                'deir_al_balah' => 'دير البلح',
                'jabalia' => 'جباليا',
                'beit_lahia' => 'بيت لاهيا',
                'beit_hanoun' => 'بيت حانون',
                'nuseirat' => 'النصيرات',
                'maghazi' => 'المغازي',
                'bureij' => 'البريج',
            ],

            'universities' => [
                'iug' => 'الجامعة الإسلامية',
                'azu' => 'جامعة الأزهر',
                'al_aqsa' => 'جامعة الأقصى',
                'ucas' => 'جامعة فلسطين',
                'ummah' => 'جامعة الأمة',
                'gaza_university' => 'جامعة غزة',
                'alquds_open' => 'القدس المفتوحة',
            ],

            'volunteer_places' => [
                'shifa_hospital' => 'مستشفى الشفاء',
                'nasser_hospital' => 'مستشفى ناصر',
                'european_gaza' => 'المستشفى الأوروبي',
                'indo_gaza_hospital' => 'المستشفى الإندونيسي',
                'red_crescent' => 'جمعية الهلال الأحمر',
                'mental_health_center' => 'مركز الصحة النفسية',
                'blood_bank' => 'بنك الدم المركزي',
                'rehab_center' => 'مركز تأهيل المعاقين',
                'social_affairs' => 'وزارة الشؤون الاجتماعية',
                'civil_defense' => 'الدفاع المدني',
                'community_centers' => 'المراكز المجتمعية',
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
