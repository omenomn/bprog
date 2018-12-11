<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker\Factory::create();

    	for ($i = 1; $i <= 50; $i++) {

	    	$category = App\Models\Category::create([
	    		'name' => $faker->name,
	    		'place' => $i,
	    	]);  

	    	for ($a = 1; $a <= 10; $a++) {
		    	$childCategory = $category->children()->create([
		    		'name' => $faker->name,
		    		'place' => $a,
		    	]);    	

		    	for ($b = 1; $b <= 10; $b++) {
			    	$childCategory->children()->create([
			    		'name' => $faker->name,
			    		'place' => $a,
			    	]);    		
	    		}	
    		}
    	}
    }
}
