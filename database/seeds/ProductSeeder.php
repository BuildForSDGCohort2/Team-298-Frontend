<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'title'                 => 'Intex LED-3216 80 cm (32) HD Ready (HDR) LED Television',
                'slug'                  =>  Str::slug('Intex LED-3216 80 cm (32) HD Ready (HDR) LED Television', '-'),
                'price'                 => '23999',
                'discount'              => '30',
                'discount_type'         => 'percentage',
                'sku'                   => 'DL-13243HD',
                'collection_id'         => '[1,2]',
                'user_id'               => '1',
                'description'           => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Dui ut ornare lectus sit.',
                'category_id'           => '1',
                'status'                => 'status',
                'seo_title'             => 'Intex LED-3216 80 cm (32) HD Ready (HDR) LED Television',
                'seo_description'       => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Dui ut ornare lectus sit.',
                'social_title'          => 'social_title',
                'social_description'    => 'social_description',
                'sizes'                 => '[24,14,32,45,50]',
                'materials'             => '[]',
                'colors'                => '["grey","black","silver"]',
                'created_at'            => now(),
                'updated_at'            => now(),
            ],
            [
                'title'                 => 'OPEN-BOX YU Yureka Plus Cyanogen - 16 GB Grey',
                'slug'                  =>  Str::slug('OPEN-BOX YU Yureka Plus Cyanogen - 16 GB Grey', '-'),
                'price'                 => '10089',
                'discount'              => '30',
                'discount_type'         => 'percentage',
                'sku'                   => 'DL-13243HD',
                'collection_id'         => '[1,2]',
                'user_id'               => '1',
                'description'           => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Dui ut ornare lectus sit.',
                'category_id'           => '2',
                'status'                => 'status',
                'seo_title'             => 'OPEN-BOX YU Yureka Plus Cyanogen - 16 GB Grey',
                'seo_description'       => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Dui ut ornare lectus sit.',
                'social_title'          => 'social_title',
                'social_description'    => 'social_description',
                'sizes'                 => '[24,14,32,45,50]',
                'materials'             => '[]',
                'colors'                => '["grey","black","silver"]',
                'created_at'            => now(),
                'updated_at'            => now(),
            ]
        ]);
    }
}
