<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Asset;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
			
                    ['donor_id'=>1,'name' => 'Ice making machine'    ,'quantity'=>1    ,'unit_price'=> 27145.27], 	
                    ['donor_id'=>1,'name' => 'FRP Boat'              ,'quantity'=>2    ,'unit_price'=>17523.76], 	
                    ['donor_id'=>1,'name' => 'Diesel Generator'      ,'quantity'=>1    ,'unit_price'=> 14935.84], 	
                    ['donor_id'=>1,'name' => 'Outboard Engine'       ,'quantity'=>2    ,'unit_price'=>4945.56], 	
                    ['donor_id'=>1,'name' => 'Insulated box'         ,'quantity'=>10   ,'unit_price'=>10038.63], 	
                    ['donor_id'=>1,'name' => 'Anchor complete set'   ,'quantity'=>2    ,'unit_price'=>159.80], 	
                    ['donor_id'=>1,'name' => 'Gear pump'             ,'quantity'=>1    ,'unit_price'=>251.13], 	
                    ['donor_id'=>1,'name' => 'strand rope'           ,'quantity'=>3    ,'unit_price'=>409.64], 	
                    ['donor_id'=>1,'name' => 'Propeller'             ,'quantity'=>4    ,'unit_price'=> 262.23], 	
                    ['donor_id'=>1,'name' => 'Transformer'           ,'quantity'=>2    ,'unit_price'=>512.17], 	
                    ['donor_id'=>1,'name' => 'Fuel tank'             ,'quantity'=>4    ,'unit_price'=> 602.32], 	
                    ['donor_id'=>1,'name' => 'Chest freezer'         ,'quantity'=>2    ,'unit_price'=>4056.43], 	
                    ['donor_id'=>1,'name' => 'Vacuum packing machine','quantity'=>1    ,'unit_price'=>9630.94], 	
                    ['donor_id'=>1,'name' => 'SSB radio'             ,'quantity'=>1    ,'unit_price'=>5633.92], 	
                    ['donor_id'=>1,'name' => 'Portable generator'    ,'quantity'=>1    ,'unit_price'=>1373.65], 	
                    ['donor_id'=>1,'name' => 'Rotary pump'           ,'quantity'=>2    ,'unit_price'=>204.87], 	
                    ['donor_id'=>1,'name' => 'Tool set'              ,'quantity'=>	1  ,'unit_price'=>1434.09],	
                    ['donor_id'=>1,'name' => 'Weighing machine'      ,'quantity'=>1	   ,'unit_price'=>921.91], 	
                    ['donor_id'=>1,'name' => 'stainless working table','quantity'=>1   ,'unit_price'=>809.24], 	
                    ['donor_id'=>1,'name' => 'Plastic bag'            ,'quantity'=>2   ,'unit_price'=>530.41], 	
                    ['donor_id'=>1,'name' => 'Manifold gauge'         ,'quantity'=>1   ,'unit_price'=>221.26], 	
                    ['donor_id'=>1,'name' => 'Ink cartridge'          ,'quantity'=>50  ,'unit_price'=>1434.09], 	
                    ['donor_id'=>1,'name' => 'Gear'                   ,'quantity'=>8   ,'unit_price'=> 360.57], 	
                    ['donor_id'=>1,'name' => 'Impeller'               ,'quantity'=>4   ,'unit_price'=>36.88], 	
                    ['donor_id'=>1,'name' => 'Stand'                  ,'quantity'=>2   ,'unit_price'=>565.44], 	

		   ] ;
        foreach ($data as $obj)
        {
            Asset::create($obj);
        }
    }
}
