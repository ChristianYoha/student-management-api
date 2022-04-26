<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\JsonResponse;

class PromotionFormRequest extends FormRequest
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
            'endYear' => 'required|numeric|digits:4',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Le nom de la promotion est requis.',
            'endYear.required' => 'L\'année de sortie est requise.',
            'endYear.numeric' => 'L\'année de sortie n\'est pas correcte',
            'endYear.digits' => 'Le nombre de caractères pour l\'année de sortie est incorrect.',
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
