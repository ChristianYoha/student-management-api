<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Promotion;
use App\Models\Semester;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call([
            UserSeed::class,
            PromotionSeed::class,
            SemesterSeed::class,
            TeacherSeed::class,
            CourseSeed::class,
            StudentSeed::class,
            RateSeed::class,
        ]);
    }
}
