<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Donor;
class DonorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [['name' => 'OFCF','description'=>'Japan' ],
         ['name' => 'JICS','description'=>'Japan'],
         ['name' => 'JICA','description'=>'Japan'],
          ['name' => 'KOFA','description'=>'Korea'], ];
        
        foreach ($data as $obj)
        {
            Donor::create($obj);
        }
    }
}
