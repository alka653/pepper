<?php

namespace App\Http\Controllers;

use App\User;
use App\Personas;
use App\Departamentos;
use Illuminate\Http\Request;
use App\Mail\UserRegisterEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ChangePasswordFormRequest;
use App\Http\Requests\RegistroUsuarioFormRequest;

class UsersController extends Controller{
	const DIR_TEMPLATE = 'usuarios.';
	public function signup(){
		return view(self::DIR_TEMPLATE.'form', [
			'departamentoLista' => Departamentos::lista(),
			'title' => 'Regístrate en Pepper',
			'route' => ['crear_cuenta.post'],
			'persona' => new Personas,
			'method' => 'post'
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
			'foto' => $request->foto != null ? $request->foto->store('personas') : ''
		]);
		$usuario = User::saveData([
			'email' => $request->email,
			'persona_id' => $persona->id,
			'perfil' => 'U'
		]);
		$usuario->assignRole('guest');
		/*
		try{
			$userData = new \stdClass();
			$userData->email = $usuario->email;
			$userData->nombre = $usuario->persona->nombre;
			$userData->apellido = $usuario->persona->apellido;
			$userData->sender = 'Pepper';
			$userData->receiver = $usuario->persona->nombre.' '.$usuario->persona->apellido;
			Mail::to($usuario->email)->send(new UserRegisterEmail($userData));
		}catch(\Exception $e){
			$request->session()->flash('message.level', 'danger');
			$request->session()->flash('message.content', 'El correo electrónico ingresado no es correcto.');
		}
		*/
		Auth::login($usuario);
		return redirect()->route('home');
	}
	public function profile($persona = ''){
		$usuario = null;
		if($persona){
			$usuario = User::where('persona_id', $persona)->first();
		}else{
			$usuario = Auth::user();
		}
		return view(self::DIR_TEMPLATE.'profile', [
			'usuario' => $usuario
		]);
	}
	public function edit(Personas $persona){
		if(Auth::user()->perfil == 'J' || ($persona->id == Auth::user()->persona_id)){
			return view(self::DIR_TEMPLATE.'form', [
				'departamentoLista' => Departamentos::lista(),
				'title' => 'Edición de datos',
				'route' => ['editar_perfil.post', $persona->id],
				'method' => 'put',
				'persona' => $persona
			]);
		}else{
			return redirect()->route('editar_perfil', ['persona' => Auth::user()->id]);
		}
	}
	public function updateData(Request $request){
		Personas::updateData($request);
		return redirect()->route('perfil_usuario', ['persona' => $request->persona]);
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
	public function getOwnerByNumDoc(Request $request){
		$data = [];
		$numero_documento = $request->input('propietario_numero_documento');
		if($numero_documento != null){
			$data = Personas::with('mascotas', 'municipio_residencia')->where('numero_documento', $numero_documento)->first();
		}
		return response()->json([
			'data' => $data
		]);
	}
}