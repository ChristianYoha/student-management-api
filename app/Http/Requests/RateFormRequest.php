<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\JsonResponse;

class RateFormRequest extends FormRequest
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
            'rate' => 'required|numeric|between:0,20',
            'student_id' => 'required|numeric|exists:students,id',
            'semester_id' => 'required|numeric|exists:semesters,id',
            'course_id' => 'required|numeric|exists:courses,id',
        ];
    }

    public function messages()
    {
        return [
            'rate.required' => 'La note est requise.',
            'student_id.required' => 'L\étudiant est requis.',
            'semester_id.required' => 'Le semestre est requis.',
            'course_id.required' => 'La matière est requises.',

            'rate.numeric' => 'La donnée n\'est pas une valeur numérique.',
            'student_id.numeric' => 'La donnée n\'est pas une valeur numérique.',
            'semester_id.numeric' => 'La donnée n\'est pas une valeur numérique.',
            'course_id.numeric' => 'La donnée n\'est pas une valeur numérique.',

            'student_id.exists' => 'Cet étudiant n\'existe pas.',
            'semester_id.exists' => 'Ce semestre n\'existe pas.',
            'course_id.exists' => 'Cette matière n\'existe pas.',

            'rate.between' => 'La note doit être entre 0 et 20',

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
