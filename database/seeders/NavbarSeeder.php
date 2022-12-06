<?php
  
namespace Database\Seeders;
  
use Illuminate\Database\Seeder;
use App\Models\Navbar;
  
class NavbarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $links = [
            // [
            //     'name' => 'Home',
            //     'route' => '',
            //     'ordering' => 1,
            // ],
            [
                'name' => 'Islands',
                'route' => 'island.index',
                'ordering' => 2,
            ],
            [
                'name' => 'Fish Center',
                'route' => 'fishcenter.index',
                'ordering' => 3,
            ],

            [
                'name' => 'Donors',
                'route' => 'donor.index',
                'ordering' => 4,
            ],

            [
                'name' => 'Assets',
                'route' => 'asset.index',
                'ordering' => 5,
            ],

            // [
            //     'name' => 'Assets',
            //     'route' => 'asset.index',
            //     'ordering' => 5,
            // ],

            [
                'name' => 'Shares',
                'route' => 'share.index',
                'ordering' => 6,
            ],

            [
                'name' => 'Stock Take',
                'route' => 'stocktake.index',
                'ordering' => 7,
            ]
        ];
  
        foreach ($links as $key => $navbar) {
            Navbar::create($navbar);
        }
    }
}