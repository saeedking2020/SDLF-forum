<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Forum;
use App\Models\Topic;
use App\Models\TopicReply;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //make 10 fake users
         User::factory(10)->create();
        //make the admin user
        User::factory()->create([
            'name' => 'Felix',
            'phone' => 'Felix',
            'address' => 'Germany',
            'is_admin' => true,
            'country' => 'Germany',
            'profession' => 'Web Developer',
            'bio' => 'A professional web developer with master of computer science degree',
            'skills' => 'php, laravel, wordpress, javascript, english and german',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin@admin.com'),
            'remember_token' => Str::random(10),
        ]);

        //make some categories with the foreign key of user_id
        Category::factory(10)->create();
        //make some categories with the foreign key of category_id
        Forum::factory(20)->create();
        //make some topics with the foreign keys of forum_id and user_id
        Topic::factory(20)->create();
        //make some topics with the foreign keys of topic_id and user_id
        TopicReply::factory(30)->create();


    }
}
