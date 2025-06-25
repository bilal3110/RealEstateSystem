<?php

namespace Database\Seeders;

use App\Models\Investment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class InvestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i=0; $i < 100; $i++) { 
            $invest = new Investment();

            $invest->prop_title = $faker->randomElement(['House','Appartment','Bangalow','Shop','Plot']);
            $invest->prop_area = $faker->randomElement(['5 Marla', '10 Marla', '15', '20 Marla']);
            $invest->prop_loc = $faker->address;
            $invest->seller_name = $faker->name;
            $invest->seller_contact = $faker->phoneNumber();
            $invest->seller_cnic = $faker->regexify('[1-9]{5}-[0-9]{7}-[0-9]');
            $invest->buying_price = $faker->numberBetween(50000, 1000000);
            $invest->my_investment = $faker->numberBetween(5000,50000);
            $invest->my_equity = $faker->numberBetween(1,100);
            $invest->is_sold = $faker->randomElement([0,1]);
            $invest->prop_img = json_encode([
                $faker->imageUrl(640, 480, 'real estate'),
                $faker->imageUrl(640, 480, 'real estate'),
            ]);
            $invest->prop_desc = $faker->sentence(10);
            $invest->save();
        }
    }
}
