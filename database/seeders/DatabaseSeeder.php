<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // إنشاء حساب الأدمن
        User::updateOrCreate(
            ['email' => 'admin@gis.com'],
            [
                'name' => 'مدير النظام',
                'email' => 'admin@gis.com',
                'password' => Hash::make('admin123'),
            ]
        );

        $this->command->info('✅ تم إنشاء حساب الأدمن:');
        $this->command->info('   البريد: admin@gis.com');
        $this->command->info('   كلمة المرور: admin123');
    }
}
