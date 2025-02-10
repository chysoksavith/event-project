<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\City;
use App\Models\User;
use App\Models\Country;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        $cambodia = Country::create([
            'name' => 'Cambodia'
        ]);
        $china = Country::create([
            'name' => 'china'
        ]);

        $cambodiaCities = [
            'Phnom Penh',
            'Siem Reap',
            'Sihanoukville',
            'Battambang',
            'Kampot'
        ];
        $chinaCities = [
            'Beijing',
            'Shanghai',
            'Guangzhou',
            'Shenzhen',
            'Chengdu'

        ];
        foreach ($cambodiaCities as $cityName) {
            City::create([
                'country_id' => $cambodia->id,
                'name' => $cityName
            ]);
        }
        foreach ($chinaCities as $cityName) {
            City::create([
                'country_id' => $china->id,
                'name' => $cityName
            ]);
        }

        $tags = [
            'laravel',
            'vue-js',
            'livewire'
        ];

        foreach ($tags as $tag) {
            Tag::create([
                'name' => $tag,
                'slug' => Str::slug($tag)
            ]);
        }
    }
}
