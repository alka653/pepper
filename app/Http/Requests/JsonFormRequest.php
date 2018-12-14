<?php

namespace App\Http\Requests;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

abstract class JsonFormRequest extends FormRequest{
	abstract public function authorize();
	abstract public function rules();
	public function failedValidation(Validator $errors){
		throw new HttpResponseException(response()->json([
			'errors' => $errors->errors(),
			'message' => 'Hay algunos campos con valores no válidos'
		], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
	}
}