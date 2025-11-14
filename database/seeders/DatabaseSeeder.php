<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Create admin user
        \App\Models\User::create([
            'name' => 'Admin User',
            'fname' => 'Admin',
            'lname' => 'User',
            'email' => 'admin@rktrading.com',
            'password' => bcrypt('password'),
            'address' => 'RK Trading Office, Manila, Philippines',
            'birthday' => '1990-01-01',
            'user_type' => 'admin',
            'email_verified' => true,
        ]);

        // Create customer user
        \App\Models\User::create([
            'name' => 'Customer User',
            'fname' => 'Customer',
            'lname' => 'User',
            'email' => 'customer@rktrading.com',
            'password' => bcrypt('password'),
            'address' => 'Manila, Philippines',
            'birthday' => '1995-05-15',
            'user_type' => 'customer',
            'email_verified' => true,
        ]);

        // Create sample products
        \App\Models\Product::create([
            'name' => 'Solar LED Bulb 12W',
            'description' => 'Energy-efficient LED bulb with built-in solar charging',
            'price' => 499.00,
            'category' => 'light',
            'stock' => 50,
            'image' => 'https://images.unsplash.com/photo-1703956807427-035f294e1467?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxzb2xhciUyMGxpZ2h0JTIwYnVsYnxlbnwxfHx8fDE3NjIxMjgyNTd8MA&ixlib=rb-4.1.0&q=80&w=1080',
            'rating' => 4.5,
            'is_active' => true,
        ]);

        \App\Models\Product::create([
            'name' => 'Outdoor Solar Garden Light',
            'description' => 'Waterproof solar garden stake lights, set of 4',
            'price' => 699.00,
            'category' => 'light',
            'stock' => 30,
            'image' => 'https://images.unsplash.com/photo-1629794773534-48e0d6061c2e?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxzb2xhciUyMG91dGRvb3IlMjBsaWdodHN8ZW58MXx8fHwxNzYyMTI4MjU3fDA&ixlib=rb-4.1.0&q=80&w=1080',
            'rating' => 4.8,
            'is_active' => true,
        ]);

        \App\Models\Product::create([
            'name' => 'Solar Rechargeable Fan 10"',
            'description' => 'Portable fan with solar panel and USB charging',
            'price' => 1299.00,
            'category' => 'fan',
            'stock' => 25,
            'image' => 'https://images.unsplash.com/photo-1523437345381-db5ee4df9c04?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxwb3J0YWJsZSUyMGZhbnxlbnwxfHx8fDE3NjIxMjgyNTd8MA&ixlib=rb-4.1.0&q=80&w=1080',
            'rating' => 4.3,
            'is_active' => true,
        ]);

        \App\Models\Product::create([
            'name' => 'Solar Panel Emergency Light',
            'description' => 'Multi-mode emergency light with 6-hour backup',
            'price' => 899.00,
            'category' => 'light',
            'stock' => 40,
            'image' => 'https://images.unsplash.com/flagged/photo-1566838616631-f2618f74a6a2?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxzb2xhciUyMHBhbmVsJTIwaG9tZXxlbnwxfHx8fDE3NjIwMDU2MzZ8MA&ixlib=rb-4.1.0&q=80&w=1080',
            'rating' => 4.6,
            'is_active' => true,
        ]);

        \App\Models\Product::create([
            'name' => 'Solar Ceiling Fan with Remote',
            'description' => '16" ceiling fan with solar panel kit and remote control',
            'price' => 2499.00,
            'category' => 'fan',
            'stock' => 15,
            'image' => 'https://images.unsplash.com/photo-1523437345381-db5ee4df9c04?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxwb3J0YWJsZSUyMGZhbnxlbnwxfHx8fDE3NjIxMjgyNTd8MA&ixlib=rb-4.1.0&q=80&w=1080',
            'rating' => 4.7,
            'is_active' => true,
        ]);

        \App\Models\Product::create([
            'name' => 'Solar LED Strip Lights 5m',
            'description' => 'Flexible waterproof LED strips with solar controller',
            'price' => 799.00,
            'category' => 'light',
            'stock' => 35,
            'image' => 'https://images.unsplash.com/photo-1629794773534-48e0d6061c2e?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxzb2xhciUyMG91dGRvb3IlMjBsaWdodHN8ZW58MXx8fHwxNzYyMTI4MjU3fDA&ixlib=rb-4.1.0&q=80&w=1080',
            'rating' => 4.4,
            'is_active' => true,
        ]);
    }
}
