<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\JsonResponse;

class TeacherFormRequest extends FormRequest
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
            'arrivalYear' => 'required|numeric|digits:4|after_or_equal:2019',
        ];
    }

    public function messages()
    {
        return [
            'lastname.required' => 'Le nom est requis.',
            'firstname.required' => 'Le prénom est requis.',
            'arrivalYear.required' => 'La date d\'arrivée est requise.',

            'arrivalYear.numeric' => 'L\'année d\'entrée n\'est pas correcte.',
            'arrivalYear.digits' => 'Le nombre de caractères pour l\'année d\'entrée est incorrect.',
            'arrivalYear.after_or_equal' => 'L\'année d\'entrée n\'est pas correcte (année à partir de 2019).',
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
