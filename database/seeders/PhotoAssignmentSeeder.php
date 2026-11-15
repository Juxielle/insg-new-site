<?php

namespace Database\Seeders;

use App\Support\PhotoAssignments;
use Illuminate\Database\Seeder;

class PhotoAssignmentSeeder extends Seeder
{
    public function run(): void
    {
        PhotoAssignments::apply();
    }
}
