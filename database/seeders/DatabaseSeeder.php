<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::create([
            "name" => "Admin",
            "username" => "admin",
            "email" => "admin@admin.com",
            "role" => 3,
            "password" => "admin",
        ]);

        // \App\Models\Category::create([
        //     "title" => "Uncategorized",
        //     "slug" => "uncategorized",
        // ]);

        \App\Models\SiteSetting::create([
            "site_title" => "TrixNews",
            "tagline" => "TrixNews",
            "description" => "TrixNews adalah website berita dan edukasi yang menyajikan informasi terkini, mendalam, dan terpercaya seputar dunia cryptocurrency, blockchain, NFT, DeFi, dan Web3. Kami hadir untuk membantu kamu memahami tren, peluang, dan risiko di ekosistem digital yang terus berkembang ini.",
            "logo_dark" => "logo_dark.png",
            "logo_light" => "logo_light.png",
            "copyright_text" => "© 2022, Oredoo, All Rights Reserved.",
            "enable_registration" => "1",
        ]);

        \App\Models\Menu::create([
            "header_menu" => json_encode([["href"=>"http://127.0.0.1:8000/","icon"=>"","text"=>"Home","tooltip"=>"","children"=>[]],["href"=>"#","icon"=>"","text"=>"AboutUs","tooltip"=>"","children"=>[]],["href"=>"#","icon"=>"","text"=>"ContactUs","tooltip"=>"","children"=>[]],["href"=>"#","icon"=>"","text"=>"PrivacyPolicy","tooltip"=>"","children"=>[]]]),
            "footer_menu" => json_encode([["href"=>"http://127.0.0.1:8000/","icon"=>"","text"=>"Home","tooltip"=>"","children"=>[]],["href"=>"#","icon"=>"","text"=>"AboutUs","tooltip"=>"","children"=>[]],["href"=>"#","icon"=>"","text"=>"ContactUs","tooltip"=>"","children"=>[]],["href"=>"#","icon"=>"","text"=>"PrivacyPolicy","tooltip"=>"","children"=>[]]]),
        ]);
    }
}
