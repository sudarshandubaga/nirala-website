<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Page::whereRaw('1=1')->delete();

        $statement = "ALTER TABLE nirala_pages AUTO_INCREMENT = 1;";
        DB::unprepared($statement);

        $page = new Page();
        $page->title = "About Us";
        $page->slug = "about-us";
        $page->save();

        $page = new Page();
        $page->title = "RERA";
        $page->slug = "rera";
        $page->save();

        $page = new Page();
        $page->title = "Vision & Mission";
        $page->slug = "vision-and-mission";
        $page->save();

        $page = new Page();
        $page->title = "Why Join Nirala";
        $page->slug = "why-join-nirala";
        $page->save();

        $page = new Page();
        $page->title = "Terms & Conditions";
        $page->slug = "terms-and-conditions";
        $page->save();

        $page = new Page();
        $page->title = "Privacy Policy";
        $page->slug = "privacy-policy";
        $page->save();

        $page = new Page();
        $page->title = "Disclaimer";
        $page->slug = "disclaimer";
        $page->save();
    }
}
