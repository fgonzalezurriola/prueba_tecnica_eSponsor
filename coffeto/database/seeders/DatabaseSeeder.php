<?php

namespace Database\Seeders;

use App\Models\Link;
use App\Models\Page;
use App\Models\Support;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Base demo user with page, links and supports (idempotent)
        $user = User::firstOrCreate(
            ['email' => 'demo@coffeto.test'],
            [
                'name' => 'Demo Creator',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
            ],
        );

        $page = Page::firstOrCreate(
            ['slug' => 'demo-creator'],
            [
                'user_id' => $user->id,
                'title' => 'Demo Creator',
                'bio' => 'I make things on the internet. Buy me a coffee.',
                'avatar_path' => 'https://avatars.githubusercontent.com/u/9919?s=200&v=4',
            ],
        );

        Link::firstOrCreate(
            [
                'page_id' => $page->id,
                'title' => 'My Portfolio',
            ],
            [
                'url' => 'https://example.com',
                'sort_order' => 1,
            ],
        );

        Link::firstOrCreate(
            [
                'page_id' => $page->id,
                'title' => 'Twitter',
            ],
            [
                'url' => 'https://twitter.com',
                'sort_order' => 2,
            ],
        );

        Support::firstOrCreate(
            [
                'page_id' => $page->id,
                'supporter_name' => 'First Fan',
                'amount' => 500,
            ],
            [
                'message' => 'Love your work!',
            ],
        );

        Support::firstOrCreate(
            [
                'page_id' => $page->id,
                'supporter_name' => 'Second Fan',
                'amount' => 900,
            ],
            [
                'message' => 'Here is another coffee.',
            ],
        );

    }
}
