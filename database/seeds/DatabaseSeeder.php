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

        $limit = 5;

        for ($i = 0; $i < $limit; $i++) {
            // $this->call(UsersTableSeeder::class);
            DB::table('dreams')->insert([
                'heading' => $faker->name.'_'.$i,
                'description' =>$faker->text,
                'user_id' =>'1',
                'tags' => $faker->name,
                'important_facts' => $faker->name,
                'created_at' => $faker->date(),
                'updated_at' => $faker->dateTime(),
            ]);
        }

    }
}
