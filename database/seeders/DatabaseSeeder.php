<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Project;
use App\Models\Education;
use App\Models\Experience;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create default admin user
        $admin = User::create([
            'name' => 'Thoriq',
            'username' => 'admin',
            'title' => 'Fullstack Web Developer',
            'bio' => 'Seorang Fullstack Web Developer yang bersemangat dalam membangun aplikasi web modern yang responsif, berkinerja tinggi, dan berestetika premium menggunakan ekosistem Laravel dan Tailwind CSS.',
            'password' => Hash::make('password'),
        ]);

        // 2. Create Dummy Projects with Layout Compositions
        $financeTracker = $admin->projects()->create([
            'title' => 'Personal Finance Tracker',
            'description' => 'A web application built with Laravel and Tailwind CSS to track daily expenses, income, and generate annual financial reports. Features beautiful interactive SVG charts and automated email notifications.',
            'image_path' => 'projects/project1.png',
            'project_link' => 'https://github.com/admin/finance-tracker',
            'grid_span' => 2,
            'thumbnail_composition' => 'split', // We will seed 1 additional mockup image to make a split collage
        ]);

        $ecommerceApi = $admin->projects()->create([
            'title' => 'E-Commerce RESTful API',
            'description' => 'A fully featured RESTful API for an online store with JWT authentication, shopping cart logic, coupon discounts, payment gateway integration (Midtrans), and an administrator analytics portal.',
            'image_path' => 'projects/project2.png',
            'project_link' => 'https://github.com/admin/ecommerce-api',
            'grid_span' => 1,
            'thumbnail_composition' => 'single', // Standard single thumbnail layout
        ]);

        $cityInfoHub = $admin->projects()->create([
            'title' => 'Smart City Info Hub',
            'description' => 'A highly responsive public information portal for smart cities, incorporating active announcements, localized weather widgets, municipal schedules, and a citizen reports portal.',
            'image_path' => 'projects/project3.png',
            'project_link' => null,
            'grid_span' => 3,
            'thumbnail_composition' => 'mosaic', // We will seed 2 additional mockup images to make a 3-image mosaic collage
        ]);

        // Seed additional mockup images with normalized configurations
        // Seed primary mockup to represent in project_images table as is_thumbnail = true
        $financeTracker->images()->create([
            'image_path' => 'projects/project1.png',
            'is_thumbnail' => true,
            'col_span' => 3, // Full viewport banner
            'row_position' => 1,
            'sort_order' => 0,
        ]);
        // 1 additional mockup for Finance Tracker to build a split grid
        $financeTracker->images()->create([
            'image_path' => 'projects/project2.png',
            'is_thumbnail' => false,
            'col_span' => 2, // Wide block
            'row_position' => 2,
            'sort_order' => 1,
        ]);

        // Seed primary cover for E-Commerce API
        $ecommerceApi->images()->create([
            'image_path' => 'projects/project2.png',
            'is_thumbnail' => true,
            'col_span' => 3,
            'row_position' => 1,
            'sort_order' => 0,
        ]);

        // Seed primary cover for Smart City Info Hub
        $cityInfoHub->images()->create([
            'image_path' => 'projects/project3.png',
            'is_thumbnail' => true,
            'col_span' => 3,
            'row_position' => 1,
            'sort_order' => 0,
        ]);
        // 2 additional mockups for Smart City Info Hub to build a mosaic collage
        $cityInfoHub->images()->create([
            'image_path' => 'projects/project1.png',
            'is_thumbnail' => false,
            'col_span' => 2,
            'row_position' => 2,
            'sort_order' => 1,
        ]);
        $cityInfoHub->images()->create([
            'image_path' => 'projects/project2.png',
            'is_thumbnail' => false,
            'col_span' => 1, // Regular grid card
            'row_position' => 2,
            'sort_order' => 2,
        ]);

        // 3. Create Dummy Educations
        $educations = [
            [
                'institution_name' => 'University of Indonesia',
                'degree' => 'Bachelor of Computer Science',
                'start_year' => 2020,
                'end_year' => 2024,
                'description' => 'Graduated with Honors (GPA 3.85/4.00). Specialized in Software Engineering, Cloud Architecture, and Web Development. Active in the Computer Science Student Association.',
            ],
            [
                'institution_name' => 'SMAN 1 Jakarta',
                'degree' => 'High School Diploma (Natural Sciences)',
                'start_year' => 2017,
                'end_year' => 2020,
                'description' => 'Ranked Top 5% in class. Active in coding clubs, robotic competitions, and student council.',
            ],
        ];

        foreach ($educations as $edu) {
            $admin->educations()->create($edu);
        }

        // 4. Create Dummy Experiences
        $experiences = [
            [
                'company_name' => 'Tech Innovators Inc.',
                'position' => 'Senior Web Developer',
                'start_date' => '2024-09-01',
                'end_date' => null, // Testing ongoing experience
                'description' => 'Lead fullstack developer responsible for constructing robust backend services, scalable microservices, and implementing aesthetic and highly interactive frontend interfaces with Tailwind CSS and Alpine.js. Improved page speed metrics by 40% through lazy-loading and query optimization.',
            ],
            [
                'company_name' => 'Creative Digital Agency',
                'position' => 'Fullstack Web Developer',
                'start_date' => '2022-07-01',
                'end_date' => '2024-08-31',
                'description' => 'Developed custom CRM systems, high-fidelity landing pages, and customized e-commerce solutions for SME clients. Integrated third-party APIs (Stripe, Twilio, SendGrid) and managed cloud deployments on AWS and DigitalOcean.',
            ],
            [
                'company_name' => 'Startup Hub Studio',
                'position' => 'Junior Web Developer Intern',
                'start_date' => '2021-06-01',
                'end_date' => '2022-06-30',
                'description' => 'Assisted in maintaining and debugging existing e-commerce systems, designing UI layouts using CSS, and implementing front-end widgets using modern JavaScript. Collaborated with UI/UX designers to translate Figma frames into functional code.',
            ],
        ];

        foreach ($experiences as $exp) {
            $admin->experiences()->create($exp);
        }

        // 5. Create Dummy Badges for Profile Skills
        $badges = [
            [
                'name' => 'Laravel 11',
                'bg_color' => '#ff5722',
                'text_color' => '#000000',
            ],
            [
                'name' => 'Tailwind CSS',
                'bg_color' => '#000000',
                'text_color' => '#ffffff',
            ],
            [
                'name' => 'MySQL',
                'bg_color' => '#ffffff',
                'text_color' => '#000000',
            ],
        ];

        foreach ($badges as $badge) {
            $admin->badges()->create($badge);
        }
    }
}
