<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\RentProperties;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for($i=0;$i<100;$i++){
            $rent = new RentProperties();
            $rent->seller_name = $faker->name;
            $rent->seller_contact = $faker->phoneNumber();
            $rent->seller_cnic = $faker->regexify('[1-9]{5}-[0-9]{7}-[0-9]');
            $rent->prop_title = $faker->randomElement(['House','Appartment','Bangalow','Shop','Plot']);
            $rent->prop_loc = $faker->address;
            $rent->prop_area = $faker->randomElement(['5 Marla', '10 Marla', '15 Marla' ,'20 Marla' ]);
            $rent->demand = $faker->numberBetween(50000, 1000000);
            $rent->prop_img = json_encode([
                $faker->imageUrl(640, 480, 'real estate'),
                $faker->imageUrl(640, 480, 'real estate'),
            ]);
            $rent->prop_desc = $faker->sentence(10);
            $rent->save();
        }
    }
}
