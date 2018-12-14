<?php

namespace App\Http\Controllers;

use App\User;
use App\Personas;
use App\Departamentos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ChangePasswordFormRequest;
use App\Http\Requests\RegistroUsuarioFormRequest;

class UsersController extends Controller{
	const DIR_TEMPLATE = 'usuarios.';
	public function signup(){
		return view(self::DIR_TEMPLATE.'signup', [
			'departamentoLista' => Departamentos::lista()
		]);
	}
	public function signupSave(RegistroUsuarioFormRequest $request){
		$persona = Personas::saveData([
			'nombre' => $request->nombre,
			'apellido' => $request->apellido,
			'numero_documento' => $request->numero_documento,
			'municipio_expedicion_id' => $request->municipio_expedicion_id,
			'direccion_residencia' => $request->direccion_residencia,
			'municipio_residencia_id' => $request->municipio_residencia_id,
			'sexo' => $request->sexo,
			'numero_celular' => $request->numero_celular,
			'numero_telefonico' => $request->numero_telefonico,
			'tipo_documento' => $request->tipo_documento,
			'ocupacion' => $request->ocupacion,
			'foto' => $request->foto->store('personas')
		]);
		$usuario = User::saveData([
			'email' => $request->email,
			'persona_id' => $persona->id,
			'perfil' => 'U'
		]);
		Auth::login($usuario);
		return redirect()->route('home');
	}
	public function profile(){
		return view(self::DIR_TEMPLATE.'profile');
	}
	public function edit(User $user){
		if(Auth::user()->perfil == 'J' || ($user->id == Auth::user()->id)){
			return view(self::DIR_TEMPLATE.'edit', [
				'user' => $user
			]);
		}else{
			return redirect()->route('editar_perfil', ['user' => Auth::user()->id]);
		}
	}
	public function changePassword(){
		return view(self::DIR_TEMPLATE.'modal_password');
	}	
	public function updatePassword(ChangePasswordFormRequest $request){
		User::updatePassword($request->password, Auth::user()->id);
		return response()->json([
			'message' => 'Contraseña actualizada con éxito'
		]);
	}
}