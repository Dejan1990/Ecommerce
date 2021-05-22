<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Category::create(['name'=>'laptop','slug'=>'laptop','description'=>'laptop category','image'=>'files/z5Or5ovDq65XsC6ojrUZOeQ5J9NnDWQfJ4wrxEkr.jpeg']);
        Category::create(['name'=>'mobile phone','slug'=>'mobile-phone','description'=>'mobile phone category','image'=>'files/8NsyyQ0d2bGnI8lMkHxTkXQ3Pc7cTjBZ9MFpUbBi.jpeg']);

        Category::create(['name'=>'books','slug'=>'books','description'=>'books category','image'=>'files/3dwitCzbBbzXscIaQM1dyGCRgvwfQnrgt56vtCtq.jpeg']);

        Subcategory::create(['name'=>'dell','category_id'=>1]);
        Subcategory::create(['name'=>'hp','category_id'=>1]);
        Subcategory::create(['name'=>'lenovo','category_id'=>1]);


        Product::create([
        	'name'=>'HP LAPTOPS',
        	'image'=>'product/Va304J3780tBF4TKAoIKJSE0SbzvJkwheUgTRSkh.jpeg',
        	'price'=> rand(700,1000),
        	'description'=>'This is the description of a product',
        	'additional_info'=>'This is additional info',
        	'category_id'=> 1,
            'subcategory_id'=>1
        ]);

        Product::create([
        	'name'=>'Dell LAPTOPS',
        	'image'=>'product/Va304J3780tBF4TKAoIKJSE0SbzvJkwheUgTRSkh.jpeg',
        	'price'=> rand(800,1000),
        	'description'=>'This is the description of a product',
        	'additional_info'=>'This is additional info',
        	'category_id'=> 1,
            'subcategory_id'=>1
        ]);

        Product::create([
        	'name'=>'LENOVO LAPTOPS',
        	'image'=>'product/Va304J3780tBF4TKAoIKJSE0SbzvJkwheUgTRSkh.jpeg',
        	'price'=> rand(700,1000),
        	'description'=>'This is the description of a product',
        	'additional_info'=>'This is additional info',
        	'category_id'=> 1,
            'subcategory_id'=>2
        ]);

        User::create([
        	'name'=>'Admin',
        	'email'=>'admin@mail.com',
        	'password'=>Hash::make('password'),
        	'email_verified_at'=>NOW(),
        	'address'=>'Australia',
        	'phone_number'=>'0576232',
        	'is_admin'=>1
        ]);
    }
}
