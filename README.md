# Project - API REST - IIM

This is an API that allows you to manage the promotions, students, teachers, courses and rates.
The API is built with Laravel 9.


## Features
- Administrator connection via JWT
- CRUD promotion
- CRUD student
- CRUD teacher
- CRUD course
- Post and get student rates

## Models
- Course
- Promotion
- Semester
- Student
- Teacher
- User (Administrators)

## Installation
```bash
    copy .env.example to .env
    composer install
    php artisan key:generate
```

Generate the JWT_SECRET key
```bash
php artisan jwt:secret 
```
- Create the database with the name you want
- Add the name of the new database in the .env file and configure your mysql connection
- Execute the migrations with the command 
```bash
php artisan migrate
```
- Execute seeds with the command 
```bash
php artisan db:seed
```
(all seeds files are called in the DatabaseSeeder file)

- Run application server
```bash
php artisan serve
```

Use Postman to test the API


## API routes and data formats

| Méthodes | Liens | Entrées | Sorties |Descriptions|
| ------ | ------ | ------ | -------| -------|
| POST | /api/auth/login |```{"email", "password"} ```| ```{"access_token", "token_type"}``` |Admin login|
|--------|
| GET | /api/promotions | | ```[{"id", "name", "endYear", "created_at", "updated_at"}, ...]``` |Show promotions|
| GET | /api/promotion/{id} | | ```{"id", "name", "endYear", "created_at", "updated_at"}``` |Show one promotion|
| POST | /api/promotion | ```{"name", "endYear"}``` | ```{"id", "name", "endYear", "created_at", "updated_at"}``` |Add promotion|
| PUT | /api/promotion/{id} | ```{"name", "endYear"}``` | ```{"id", "name", "endYear", "created_at", "updated_at"}``` |update promotion|
|--------|
| GET | /api/students | | ```[{"id", "lastname", "firstname", "birthdate", "arrivalYear", "created_at", "updated_at", "promotion_id", "promotion":{"id", "name", "endYear", "created_at", "updated_at"}, ...```] |Show students and their promotion|
| GET | /api/students/create | | ```"promotions":[{"id", "name", "endYear", "created_at", "updated_at"}, ...```] |To pre-load the creation form|
| GET | /api/student/{id} | | ```{"id", "lastname, "firstname", "birthdate", "arrivalYear", "created_at", "updated_at", "promotion_id", "promotion":{"id", "name", "endYear", "created_at", "updated_at"}``` |Show one student and his promotion|
| POST | /api/student | ```{"lastname, "firstname", "birthdate", "arrivalYear","promotion_id"}``` | ```{"id", "name", "endYear", "created_at", "updated_at"}``` |add student and his promotion|
| GET | /api/student/{id}/edit | | ```{"id", "lastname, "firstname", "birthdate", "arrivalYear","promotions":[{"id", "name", "endYear", "created_at", "updated_at"}, ...]}``` |To pre-load the edition form|
| PUT | /api/student/{id} | ```{"lastname, "firstname", "birthdate", "arrivalYear","promotion_id"}``` | ```{"id", "lastname, "firstname", "birthdate", "arrivalYear", "created_at", "updated_at", "promotion_id", "promotion":{"id", "name", "endYear", "created_at", "updated_at"}``` |Update  student|
| DELETE | /api/student/{id} | | |Delete student|
|--------|
| GET | /api/teachers | | ```[{"id", "lastname", "firstname", "arrivalYear", "created_at", "updated_at", "courses":[{"id", "name", "startDate","totalCourseHours", "courseHoursByDay", "created_at", "updated_at", "teacher_id", "promotion_id", "endDate", "promotion":{"id", "name", "endYear", "created_at", "updated_at"}},...]}, ...]``` |Show teachers, their courses and courses's promotion|
| GET | /api/teacher/{id} | | ```{"id", "lastname", "firstname", "arrivalYear", "created_at", "updated_at", "courses":[{"id", "name", "startDate","totalCourseHours", "courseHoursByDay", "created_at", "updated_at", "teacher_id", "promotion_id", "endDate", "promotion":{"id", "name", "endYear", "created_at", "updated_at"}},...]}``` |Show one teacher, his courses and courses's promotion|
| POST | /api/teacher | ```{"lastname, "firstname", "arrivalYear"}``` | ```{"id", "lastname", "firstname", "arrivalYear", "created_at", "updated_at"}``` |Add teacher|
| GET | /api/teacher/{id}/edit | | ```{"id", "lastname", "firstname", "arrivalYear"}``` |To pre-load the edition form|
| PUT | /api/teacher/{id} | ```{"lastname, "firstname", "arrivalYear"}``` | ```{"id", "lastname", "firstname", "arrivalYear", "created_at", "updated_at"}``` |Update teacher|
| DELETE | /api/teacher/{id} | | |Delete teacher|
|--------|
| GET | /api/courses | | ```[{"id", "name", "startDate", "totalCourseHours", "courseHoursByDay", "created_at", "updated_at", "teacher_id","promotion_id","endDate", "teacher":{"id", "lastname", "firstname","arrivalYear", "created_at", "updated_at"}, "promotion":{"id", "name", "endYear", "created_at", "updated_at"}, ...]``` |Show courses, their teachers and promotions|
| GET | /api/course/create | | ```"teachers":[{"id", "lastname", "firstname","arrivalYear", "created_at", "updated_at"},...], "promotions":[{"id", "name", "endYear", "created_at", "updated_at"}, ...]``` |To pre-load the creation form|
| GET | /api/course/{id} | | ```{"id", "name", "startDate", "totalCourseHours", "courseHoursByDay", "created_at", "updated_at", "teacher_id","promotion_id","endDate", "teacher":{"id", "lastname", "firstname","arrivalYear", "created_at", "updated_at"}, "promotion":{"id", "name", "endYear", "created_at", "updated_at"}``` |Show one course, their teachers and promotions|
| POST | /api/course | ```{"name", "startDate", "totalCourseHours", "courseHoursByDay", "teacher_id","promotion_id"}``` | ```{"id", "name", "startDate", "totalCourseHours", "courseHoursByDay", "created_at", "updated_at", "teacher_id","promotion_id","endDate", "teacher":{"id", "lastname", "firstname","arrivalYear", "created_at", "updated_at"}, "promotion":{"id", "name", "endYear", "created_at", "updated_at"}``` |Add course, set his teacher and his promotion|
| GET | /api/course/{id}/edit | | ```{"id", "name", "startDate", "totalCourseHours", "courseHoursByDay", "teacher_id","promotion_id","teachers":[{"id", "lastname", "firstname","arrivalYear", "created_at", "updated_at"},...],"promotions":[{"id", "name", "endYear", "created_at", "updated_at"}, ...]}``` |To pre-load the edition form|
| PUT | /api/course/{id} | ```{"name", "startDate", "totalCourseHours", "courseHoursByDay", "teacher_id","promotion_id"}``` | ```{"id", "name", "startDate", "totalCourseHours", "courseHoursByDay", "created_at", "updated_at", "teacher_id","promotion_id","endDate", "teacher":{"id", "lastname", "firstname","arrivalYear", "created_at", "updated_at"}, "promotion":{"id", "name", "endYear", "created_at", "updated_at"}``` |Update course|
|--------|
| GET | /api/rate/{student_id} | |```{"semester":{"id", "name", ...}, "data":[{"courses":{"id", "name",...}, "rate"}, ...]}``` |Show rates's student by semesters and courses|
| GET | /api/new_rate/{student_id}/create | | ```{"student":{"id", "lastname", "firstname",..., "promotion":{"id", "name",...,"courses":[{"id", "name", "startDate", ...},...]}}, "semester":[{"id", "name", ...}, ...]}``` |To pre-load the add form|
| POST | /api/new_rate | ```{"semester_id, "course_id", "student_id", "rate"}``` | | Add rate|

## Others features
- Server-side form validation
- Custom request file for form validation
- Custom API json responses
