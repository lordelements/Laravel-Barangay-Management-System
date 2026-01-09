<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\BrgyOfficialPosition;
use Illuminate\Database\Seeder;

class PositionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         BrgyOfficialPosition::updateOrCreate(
           [
                'position'   => 'Punong Barangay',
                'max_active' => 1
            ]
        );

        BrgyOfficialPosition::updateOrCreate(
            [
                'position'   => 'Barangay Kagawad',
                'max_active' => 7
            ]
        );
    }
}