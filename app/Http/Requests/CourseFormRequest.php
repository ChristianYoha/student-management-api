<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\JsonResponse;

class CourseFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'name' => 'required',
            'startDate' => 'required|date|date_format:Y-m-d',
            'totalCourseHours' => 'required|numeric|',
            'courseHoursByDay' => 'required|numeric|',
            'promotion_id' => 'required|numeric|exists:promotions,id',
            'teacher_id' => 'required|numeric|exists:teachers,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Le nom du cours est requis.',
            'startDate.required' => 'La date de début est requise.',
            'promotion_id.required' => 'La promotion est requise.',
            'teacher_id.required' => 'L\' intervenant est requis.',

            'startDate.date' => 'La donnée saisie n\'est pas une date.',
            'startDate.date_format' => 'La date de début du cours saisie n\'est pas au bon format.',


            'promotion_id.numeric' => 'Cette promotion n\'existe pas.',
            'promotion_id.exists' => 'Cette promotion n\'existe pas.',
            'teacher_id.numeric' => 'Cette promotion n\'existe pas.',
            'teacher_id.exists' => 'Cette promotion n\'existe pas.'
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();

        throw new HttpResponseException(response()->json([
            'errors' => $errors,
            'old' => $this->all()
        ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }
}
