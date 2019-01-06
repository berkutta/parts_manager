<?php

use Illuminate\Database\Seeder;

class ComponentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Storage::class, 50)->create()->each(function ($storage) {
            $storage->components()->save(factory(App\Component::class)->make());
        });
    }
}
