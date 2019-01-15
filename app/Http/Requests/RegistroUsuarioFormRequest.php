<?php

namespace App\Http\Requests;

use App\Http\Requests\UserPasswordFormRequest;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\UsuarioFormRequest;
use App\Http\Requests\PersonaFormRequest;

class RegistroUsuarioFormRequest extends FormRequest{
	public function authorize(){
		return true;
	}
	public function rules(){
		$rules = [];
		$formRequests = [
			PersonaFormRequest::class,
			UsuarioFormRequest::class,
			UserPasswordFormRequest::class
		];
		foreach ($formRequests as $source) {
			$rules = array_merge($rules, (new $source)->rules());
		}
		return $rules;
	}
	public function messages(){
		$messages = [];
		$formRequests = [
			PersonaFormRequest::class,
			UsuarioFormRequest::class,
			UserPasswordFormRequest::class,
		];
		foreach ($formRequests as $source) {
			$messages = array_merge($messages, (new $source)->messages());
		}
		return $messages;
	}
}