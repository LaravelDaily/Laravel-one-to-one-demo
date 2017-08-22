<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Company;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 10)->create()->each(function ($user) {
            $user->company()->save(factory(Company::class)->create());
        });
    }
}
