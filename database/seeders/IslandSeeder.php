<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Island;
class IslandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Abaiang' ],
            ['name' => 'Abemama'],
            ['name' => 'Aranuka'],
            ['name' => 'Arorae' ],
            ['name' => 'Beru'],
            ['name' => 'Kuria'],
            ['name' => 'Maiana'],
            ['name' => 'Makin' ],
            ['name' => 'Marakei'],
            ['name' => 'Nikunau'],
            ['name' => 'Nonouti'],
            ['name' => 'Onotoa'],
            ['name' => 'Tabiteuea North'],
            ['name' => 'Tabiteuea South'],
            ['name' => 'Tamana'],
            ['name' => 'North Tarawa'],
            ['name' => 'South Tarawa'],
            ['name' => 'Tabuaeran'],
            ['name' => 'Teraina'],
            ['name' => 'Kiritimati'],
            ['name' => 'Banaba'],

        
        ];
        
        foreach ($data as $obj)
        {
            Island::create($obj);
        }
    }
}
