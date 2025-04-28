<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    public function run()
    {
        $menus = [
            [
                'name' => 'User',
                'deskripsi' => 'User',
                'link_menu' => '/users',
            ],
            [
                'name' => 'Role',
                'deskripsi' => 'Role',
                'link_menu' => '/roles',
            ],
            [
                'name' => 'Venue',
                'deskripsi' => 'Venue',
                'link_menu' => '/venues',
            ],
            [
                'name' => 'Event',
                'deskripsi' => 'Event',
                'link_menu' => '/events',
            ],
            [
                'name' => 'Menu',
                'deskripsi' => 'Menu',
                'link_menu' => '/menus',
            ],
            [
                'name' => 'Setting',
                'deskripsi' => 'Setting',
                'link_menu' => '/settings',
            ],
            [
                'name' => 'Booking',
                'deskripsi' => 'Booking',
                'link_menu' => '/bookings',
            ],
        ];

        DB::table('menus')->insert($menus);
    }
}
