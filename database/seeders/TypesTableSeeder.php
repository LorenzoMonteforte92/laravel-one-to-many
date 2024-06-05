<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Type;


class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ['FrontEnd', 'Backend', 'FullStack', 'Design', 'DevOps', 'miscellaneous'];

        foreach($types as $singleType) {

            $newType = new Type();
            $newType->name = $singleType;
            $newType->slug = Str::slug($newType->name, '-');
            $newType->save();
        }
    }
}
