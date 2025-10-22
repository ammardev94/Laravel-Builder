<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;
use App\Models\PageSection;
use App\Models\PageSectionField;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $page = Page::create([
            'name' => 'Home',
            'slug' => 'home',
            'title' => 'Welcome to Our Website',
            'canonical_url' => 'https://example.com/home',
            'status' => true,
            'type' => 'static',
            'visibility' => 'index-follow',
        ]);

        $hero = PageSection::create([
            'page_id' => $page->id,
            'name' => 'hero_section',
            'label' => 'Hero Section',
            'sort_order' => 1,
            'background_type' => 'image',
            'background_value' => '/uploads/hero-bg.jpg',
        ]);

        PageSectionField::insert([
            [
                'page_section_id' => $hero->id,
                'field_name' => 'title',
                'field_label' => 'Main Title',
                'field_type' => 'text',
                'field_value' => 'Empowering Your Digital Presence',
                'sort_order' => 1,
            ],
            [
                'page_section_id' => $hero->id,
                'field_name' => 'subtitle',
                'field_label' => 'Sub Title',
                'field_type' => 'textarea',
                'field_value' => 'We build custom solutions for modern businesses.',
                'sort_order' => 2,
            ],
            [
                'page_section_id' => $hero->id,
                'field_name' => 'button_text',
                'field_label' => 'Button Text',
                'field_type' => 'text',
                'field_value' => 'Get Started',
                'sort_order' => 3,
            ],
            [
                'page_section_id' => $hero->id,
                'field_name' => 'button_link',
                'field_label' => 'Button Link',
                'field_type' => 'link',
                'field_value' => '/contact',
                'sort_order' => 4,
            ],
        ]);
    }
}
