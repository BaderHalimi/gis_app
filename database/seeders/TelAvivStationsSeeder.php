<?php

namespace Database\Seeders;

use App\Models\Station;
use Illuminate\Database\Seeder;

class TelAvivStationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stations = [
            // محطات غاز - Gas Stations
            [
                'name' => 'محطة غاز تل أبيب المركزية',
                'type' => 'gas',
                'lat' => 32.0853,
                'lng' => 34.7818,
                'address' => 'شارع دزنغوف، تل أبيب',
                'description' => 'محطة غاز رئيسية في وسط تل أبيب',
                'prices' => ['gas_cylinder' => 45, 'refill' => 25],
                'images' => null,
            ],
            [
                'name' => 'محطة غاز يافا',
                'type' => 'gas',
                'lat' => 32.0515,
                'lng' => 34.7527,
                'address' => 'شارع يافا القديمة، تل أبيب',
                'description' => 'محطة غاز في منطقة يافا',
                'prices' => ['gas_cylinder' => 42, 'refill' => 23],
                'images' => null,
            ],

            // محطات بترول - Petrol Stations
            [
                'name' => 'محطة بترول روتشيلد',
                'type' => 'petrol',
                'lat' => 32.0636,
                'lng' => 34.7722,
                'address' => 'شارع روتشيلد، تل أبيب',
                'description' => 'محطة وقود كاملة الخدمات',
                'prices' => ['petrol_95' => 7.20, 'petrol_98' => 7.80, 'diesel' => 6.50],
                'images' => null,
            ],
            [
                'name' => 'محطة بترول هيركون',
                'type' => 'petrol',
                'lat' => 32.1093,
                'lng' => 34.8375,
                'address' => 'شارع هيركون، تل أبيب',
                'description' => 'محطة وقود على الطريق الرئيسي',
                'prices' => ['petrol_95' => 7.15, 'petrol_98' => 7.75, 'diesel' => 6.45],
                'images' => null,
            ],

            // محطات دفاع مدني - Fire Stations
            [
                'name' => 'محطة إطفاء تل أبيب المركزية',
                'type' => 'fire',
                'lat' => 32.0731,
                'lng' => 34.7925,
                'address' => 'شارع ابن جبيرول، تل أبيب',
                'description' => 'محطة الإطفاء الرئيسية في تل أبيب',
                'prices' => null,
                'images' => null,
            ],
            [
                'name' => 'محطة إطفاء جنوب تل أبيب',
                'type' => 'fire',
                'lat' => 32.0458,
                'lng' => 34.7612,
                'address' => 'شارع فلورنتين، تل أبيب',
                'description' => 'محطة إطفاء تخدم جنوب المدينة',
                'prices' => null,
                'images' => null,
            ],
        ];

        foreach ($stations as $station) {
            Station::create($station);
        }

        $this->command->info('تم إضافة 6 محطات في تل أبيب بنجاح!');
    }
}
