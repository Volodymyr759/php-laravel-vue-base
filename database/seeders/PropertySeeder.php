<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $properties = [
            ['address' => '2 Bond Street, Sydney, NSW 2000', 'status' => 'Available', 'baths' => 1, 'beds' => 2, 'square' => 60, 'price' => 550 ],
            ['address' => '23 Shelley Street, Sydney, NSW 2000', 'status' => 'Not Available', 'baths' => 2, 'beds' => 2, 'square' => 90, 'price' => 650 ],
            ['address' => '38 York Street, Sydney, NSW 2000', 'status' => 'Available', 'baths' => 3, 'beds' => 3, 'square' => 110, 'price' => 450 ],
            ['address' => '71 Macquarie Street, Sydney, NSW 2000', 'status' => 'Not Available', 'baths' => 1, 'beds' => 2, 'square' => 50, 'price' => 750 ],
            ['address' => '91 Liverpool Street, Sydney, NSW 2000', 'status' => 'Available', 'baths' => 1, 'beds' => 2, 'square' => 60, 'price' => 510 ],
            ['address' => '98 Gloucester Street, Sydney, NSW 2000', 'status' => 'Available', 'baths' => 2, 'beds' => 2, 'square' => 90, 'price' => 650 ],
            ['address' => '115 Bathurst Street, Sydney, NSW 2000', 'status' => 'Not Available', 'baths' => 1, 'beds' => 1, 'square' => 50, 'price' => 570 ],
            ['address' => '116 Bathurst Street, Sydney, NSW 2000', 'status' => 'Available', 'baths' => 3, 'beds' => 3, 'square' => 120, 'price' => 750 ],
            ['address' => '160 King Street, Sydney, NSW 2000', 'status' => 'Available', 'baths' => 1, 'beds' => 1, 'square' => 50, 'price' => 550 ],
            ['address' => '187 Kent Street, Sydney, NSW 2000', 'status' => 'Not Available', 'baths' => 2, 'beds' => 2, 'square' => 90, 'price' => 850 ],
            ['address' => '197 Castlereagh Street, Sydney, NSW 2000', 'status' => 'Available', 'baths' => 1, 'beds' => 1, 'square' => 60, 'price' => 450 ],
            ['address' => '303 Castlereagh Street, Sydney, NSW 2000', 'status' => 'Available', 'baths' => 3, 'beds' => 3, 'square' => 120, 'price' => 650 ],
            ['address' => '321 Castlereagh Street, Sydney, NSW 2000', 'status' => 'Not Available', 'baths' => 1, 'beds' => 2, 'square' => 50, 'price' => 450 ],
            ['address' => '343-357 Pitt Street, Sydney, NSW 2000', 'status' => 'Available', 'baths' => 2, 'beds' => 2, 'square' => 90, 'price' => 570 ],
            ['address' => '393 Pitt Street, Sydney, NSW 2000', 'status' => 'Available', 'baths' => 1, 'beds' => 1, 'square' => 60, 'price' => 450 ],
            ['address' => '533 Kent Street, Sydney, NSW 2000', 'status' => 'Not Available', 'baths' => 3, 'beds' => 3, 'square' => 120, 'price' => 590 ],
        ];

        DB::table('properties')->delete();

        DB::table('properties')->insert($properties);
    }
}
