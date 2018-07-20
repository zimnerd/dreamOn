<?php

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
        $faker = Faker\Factory::create();

        $limit = 33;

        for ($i = 0; $i < $limit; $i++) {
            // $this->call(UsersTableSeeder::class);
            DB::table('dreams')->insert([
                'heading' => $faker->title,
                'description' =>$faker->text,
                'tags' => $faker->title,
                'important_facts' => $faker->title,
            ]);
        }

    }
}
