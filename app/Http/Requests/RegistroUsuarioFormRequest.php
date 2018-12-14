<?php

namespace App\Http\Requests;

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
		];
		foreach ($formRequests as $source) {
			$rules = array_merge($rules, (new $source)->rules());
		}
		return $rules;
	}
}