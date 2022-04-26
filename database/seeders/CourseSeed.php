<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        // Set Course data
        $courses = [
            // A2
            ['name' => 'CSS – Layout Flex/Grid', 'startDate' => '2021-09-15', 'totalCourseHours' => 15, 'courseHoursByDay' => 5, 'teacher_id' => 1, 'promotion_id' => 1],
            ['name' => 'Architecture front-end', 'startDate' => '2021-09-28', 'totalCourseHours' => 15, 'courseHoursByDay' => 5, 'teacher_id' => 1, 'promotion_id' => 1],
            ['name' => 'Javascript', 'startDate' => '2021-10-5', 'totalCourseHours' => 15, 'courseHoursByDay' => 5, 'teacher_id' => 2, 'promotion_id' => 1],
            ['name' => 'PHP orienté objet', 'startDate' => '2021-10-18', 'totalCourseHours' => 15, 'courseHoursByDay' => 5, 'teacher_id' => 3, 'promotion_id' => 1],
            ['name' => 'Gestion de projet', 'startDate' => '2021-10-26', 'totalCourseHours' => 15, 'courseHoursByDay' => 5, 'teacher_id' => 8, 'promotion_id' => 1],

            // A3
            ['name' => 'CSS – Avancé', 'startDate' => '2021-09-15', 'totalCourseHours' => 15, 'courseHoursByDay' => 5, 'teacher_id' => 1, 'promotion_id' => 2],
            ['name' => 'React', 'startDate' => '2021-09-28', 'totalCourseHours' => 15, 'courseHoursByDay' => 5, 'teacher_id' => 6, 'promotion_id' => 2],
            ['name' => 'Python', 'startDate' => '2021-10-5', 'totalCourseHours' => 15, 'courseHoursByDay' => 5, 'teacher_id' => 2, 'promotion_id' => 2],
            ['name' => 'Création d’API', 'startDate' => '2021-10-18', 'totalCourseHours' => 15, 'courseHoursByDay' => 5, 'teacher_id' => 3, 'promotion_id' => 2],
            ['name' => 'Symfony', 'startDate' => '2021-10-26', 'totalCourseHours' => 15, 'courseHoursByDay' => 5, 'teacher_id' => 3, 'promotion_id' => 2],
            ['name' => 'Kotlin', 'startDate' => '2021-10-26', 'totalCourseHours' => 15, 'courseHoursByDay' => 5, 'teacher_id' => 5, 'promotion_id' => 2],
            ['name' => 'DevLab', 'startDate' => '2021-10-26', 'totalCourseHours' => 15, 'courseHoursByDay' => 5, 'teacher_id' => 4, 'promotion_id' => 2],

            // A4
            ['name' => 'Agile et lean', 'startDate' => '2021-09-15', 'totalCourseHours' => 15, 'courseHoursByDay' => 5, 'teacher_id' => 1, 'promotion_id' => 3],
            ['name' => 'Gestion de projet', 'startDate' => '2021-09-28', 'totalCourseHours' => 15, 'courseHoursByDay' => 5, 'teacher_id' => 8, 'promotion_id' => 3],
            ['name' => 'De la big data à l’intelligence artificielle', 'startDate' => '2021-10-5', 'totalCourseHours' => 15, 'courseHoursByDay' => 5, 'teacher_id' => 2, 'promotion_id' => 3],
            ['name' => 'Transformation digitale dans l’entreprise', 'startDate' => '2021-10-18', 'totalCourseHours' => 15, 'courseHoursByDay' => 5, 'teacher_id' => 4, 'promotion_id' => 3],
            ['name' => 'Séminaire soft skills', 'startDate' => '2021-10-26', 'totalCourseHours' => 15, 'courseHoursByDay' => 5, 'teacher_id' => 8, 'promotion_id' => 3],

            // A5
            ['name' => 'Vision et roadmap produit', 'startDate' => '2021-09-15', 'totalCourseHours' => 15, 'courseHoursByDay' => 5, 'teacher_id' => 1, 'promotion_id' => 4],
            ['name' => 'Hackathon', 'startDate' => '2021-09-28', 'totalCourseHours' => 15, 'courseHoursByDay' => 5, 'teacher_id' => 1, 'promotion_id' => 2],
            ['name' => 'Conférences et salons', 'startDate' => '2021-10-5', 'totalCourseHours' => 15, 'courseHoursByDay' => 5, 'teacher_id' => 4, 'promotion_id' => 4],
            ['name' => 'Séminaire soft skills', 'startDate' => '2021-10-18', 'totalCourseHours' => 15, 'courseHoursByDay' => 5, 'teacher_id' => 7, 'promotion_id' => 4],
            ['name' => 'Entreprise et business model', 'startDate' => '2021-10-26', 'totalCourseHours' => 15, 'courseHoursByDay' => 5, 'teacher_id' => 8, 'promotion_id' => 4],
        ];
        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}
