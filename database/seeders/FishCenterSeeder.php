<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FishCenter;
class FishCenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
      
            ['name' =>'FC-ABM', 'island_id'=>2],
            ['name' =>'FC-ARK', 'island_id'=>3],
            ['name' =>'FC-ARE', 'island_id'=>4 ],
            ['name' =>'FC-BRU', 'island_id'=>5],
            ['name' =>'FC-KRA', 'island_id'=>6],
            ['name' =>'FC-MIA', 'island_id'=>7],
            ['name' =>'FC-MKN', 'island_id'=>8 ],
            ['name' =>'FC-MRI', 'island_id'=>9],
            ['name' =>'FC-NKU', 'island_id'=>10],
            ['name' =>'FC-NOI', 'island_id'=>11],
            ['name' =>'FC-OTA', 'island_id'=>12],
            ['name' =>'FC-TUN', 'island_id'=>13],
            ['name' =>'FC-TUS', 'island_id'=>14],
            ['name' =>'FC-TMA', 'island_id'=>15],
            ['name' =>'FC-TET', 'island_id'=>16],
            ['name' =>'FC-TIA', 'island_id'=>17],
            ['name' =>'FC-TBN', 'island_id'=>18],
            ['name' =>'FC-TRA', 'island_id'=>19],
            ['name' =>'FC-KMT', 'island_id'=>20],
            ['name' =>'FC-BBA', 'island_id'=>21],
            ['name' =>'FC-ABG', 'island_id'=>1],
        
        ];
        
        foreach ($data as $obj)
        {
            FishCenter::create($obj);
        }
    }
}
