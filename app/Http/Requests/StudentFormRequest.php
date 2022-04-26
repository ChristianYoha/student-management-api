<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\JsonResponse;

class StudentFormRequest extends FormRequest
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
            'lastname' => 'required',
            'firstname' => 'required',
            'birthdate' => 'required|date|date_format:Y-m-d|before_or_equal:2001-01-01|after_or_equal:1993-01-01',
            'arrivalYear' => 'required|numeric|digits:4|after_or_equal:2019',
            'promotion_id' => 'required|numeric|exists:promotions,id',
        ];
    }

    public function messages()
    {
        return [
            'lastname.required' => 'Le nom est requis.',
            'firstname.required' => 'Le prénom est requis.',
            'birthdate.required' => 'La date de naissance est requise.',
            'arrivalYear.required' => 'La date d\'arrivée est requise.',
            'promotion_id.required' => 'La promotion est requises.',

            'birthdate.date' => 'La donnée saisie n\'est pas une date.',
            'birthdate.date_format' => 'La date de naissance saisie n\'est pas au bon format.',
            'birthdate.before_or_equal' => 'La date de naissance n\'est pas correcte (année comprise entre 1994 et 2002).',
            'birthdate.after_or_equal' => 'La date de naissance n\'est pas correcte (année comprise entre 1994 et 2002).',

            'arrivalYear.numeric' => 'L\'année d\'entrée n\'est pas correcte.',
            'arrivalYear.digits' => 'Le nombre de caractères pour l\'année d\'entrée est incorrect.',
            'arrivalYear.after_or_equal' => 'L\'année d\'entrée n\'est pas correcte (année à partir de 2019).',

            'promotion_id.numeric' => 'Cette promotion n\'existe pas.',
            'promotion_id.exists' => 'Cette promotion n\'existe pas.'
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
