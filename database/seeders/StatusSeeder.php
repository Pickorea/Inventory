<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status;
class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Defects' ],
            ['name' => 'Good'],
            // ['name' => 'Aranuka'],
            // ['name' => 'Arorae' ],
            // ['name' => 'Beru'],
            // ['name' => 'Kuria'],
           

        
        ];
        
        foreach ($data as $obj)
        {
            Status::create($obj);
        }
    }
}
