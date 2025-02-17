<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Blog;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::where('email', 'admin@admin.com')->first();

        if (!$admin) {
            throw new \Exception('Admin user not found. Please run AdminUserSeeder first.');
        }

        $blogs = [
            [
                'title' => 'Top 10 Training Tips for Young Athletes',
                'description' => 'Essential training tips for aspiring young athletes to improve their performance and prevent injuries.',
                'content' => "1. Start with proper warm-up exercises\n2. Focus on technique before intensity\n3. Stay hydrated throughout training\n4. Get adequate rest between sessions\n5. Maintain a balanced diet\n6. Listen to your body\n7. Set realistic goals\n8. Practice consistently\n9. Work on flexibility\n10. Don't skip cool-down routines",
                'category' => 'Training',
                'tags' => ['training', 'youth', 'tips', 'performance'],
                'is_published' => true,
                'is_featured' => true,
                'youtube_link' => 'https://www.youtube.com/watch?v=example1'
            ],
            [
                'title' => 'The Importance of Mental Health in Sports',
                'description' => 'Understanding the crucial role of mental health in athletic performance and overall well-being.',
                'content' => "Mental health is just as important as physical fitness in sports. Athletes face unique pressures and challenges that can affect their mental well-being. This article explores various aspects of mental health in sports and provides strategies for maintaining psychological wellness while pursuing athletic excellence.",
                'category' => 'Health',
                'tags' => ['mental health', 'wellness', 'psychology', 'performance'],
                'is_published' => true,
                'is_featured' => true,
                'youtube_link' => 'https://www.youtube.com/watch?v=example2'
            ],
            [
                'title' => 'Nutrition Guide for Athletes',
                'description' => 'A comprehensive guide to proper nutrition for optimal athletic performance.',
                'content' => "Proper nutrition is fundamental to athletic success. This guide covers essential nutrients, meal timing, hydration, and supplementation. Learn how to fuel your body for peak performance and recovery.",
                'category' => 'Nutrition',
                'tags' => ['nutrition', 'diet', 'health', 'performance'],
                'is_published' => true,
                'is_featured' => false,
                'youtube_link' => null
            ],
            [
                'title' => 'Injury Prevention Strategies',
                'description' => 'Learn effective strategies to prevent common sports injuries and maintain long-term athletic health.',
                'content' => "Prevention is better than cure. This comprehensive guide covers various strategies to prevent sports injuries, including proper warm-up techniques, equipment use, and training methods. Stay healthy and perform at your best.",
                'category' => 'Health',
                'tags' => ['injury prevention', 'safety', 'health', 'training'],
                'is_published' => true,
                'is_featured' => false,
                'youtube_link' => null
            ]
        ];

        foreach ($blogs as $blog) {
            $blog['user_id'] = $admin->id;
            $blog['slug'] = Str::slug($blog['title']);
            Blog::create($blog);
        }
    }
}
