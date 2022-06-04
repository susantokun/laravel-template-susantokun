<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configurations')->insert(
            [
                [
                    'code'               => 'LTS',
                    'title'              => 'Laravel Template Susantokun',
                    'title_short'        => 'LTS',
                    'desc'               => 'Laravel Template for Backend and Frontend by Susantokun',
                    'slogan'             => 'Easy to create dynamic template',
                    'author'             => 'Susantokun',
                    'favicon_name'       => 'Laravel Template Susantokun Icon',
                    'favicon_file'       => 'images/icons/favicon.png',
                    'logo_name'          => 'Laravel Template Susantokun Logo',
                    'logo_file'          => 'images/logos/logo512.png',
                    'logo2_name'         => null,
                    'logo2_file'         => null,
                    'address'            => 'company_address',
                    'email'              => 'admin@susantokun.com',
                    'phone'              => '081906515912',
                    'map_src'            => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d647.6404181247285!2d106.80256959985877!3d-6.204381059762995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f6bb12856033%3A0x5325e5a24ac38e7!2sBNI%20Tower!5e0!3m2!1sen!2sid!4v1633800914857!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
                    'map_link'           => 'company_map_link',
                    'place_of_birth'     => 'Indonesia',
                    'date_of_birth'      => '2022-06-01',
                    'keywords'           => 'laravel template, template admin, susantokun',
                    'metatext'           => 'metatext',
                    'api_key'            => 'api_key',
                    'about'              => '<p>I am About</p>',
                    'privacy_policy'     => '<p>I am Privacy Policy</p>',
                    'term_and_condition' => '<p>I am Term And Condition</p>',
                    'status'             => 1,
                    'created_at'         => date('Y-m-d H:i:s'),
                    'updated_at'         => date('Y-m-d H:i:s')
                ]
            ]
        );
    }
}
