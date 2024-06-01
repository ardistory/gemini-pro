<?php

namespace Database\Seeders;

use App\Models\Services;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'code_service' => 1,
                'name_service' => 'TextAI'
            ],
            [
                'code_service' => 2,
                'name_service' => 'ImageAI'
            ]
        ];
        foreach ($services as $service) {
            Services::query()->create($service);
        }
    }
}
