<?php

Route::get('/', 'HomeController@index')->name('home');
Route::prefix('/crear-cuenta')->group(function(){
	Route::get('/', 'UsersController@signup')->name('crear_cuenta');
	Route::post('/', 'UsersController@signupSave')->name('crear_cuenta.post');
});
Route::prefix('/ingresar')->group(function(){
	Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');
	Route::post('/', 'Auth\LoginController@login')->name('login.post');
});
Route::get('/municipios/obtener-by-departamento/{departamento}', 'MunicipíosController@getByDepartament')->name('obtener_municipio');
Route::group(['middleware' => 'auth'], function(){
	Route::get('/salir', 'Auth\LoginController@logout')->name('logout');
	Route::prefix('/mascotas')->group(function(){
		Route::get('/', 'MascotasController@list')->name('listar_mascota');
		Route::get('/verificar', 'MascotasController@verifyCountPets')->name('verificar_usuario_mascotas');
		Route::prefix('/crear')->group(function(){
			Route::get('/', 'MascotasController@new')->name('crear_mascota');
			Route::post('/', 'MascotasController@saveOrUpdateData')->name('crear_mascota.post');
		});
		Route::prefix('/{mascota}')->group(function(){
			Route::get('/', 'MascotasController@detail')->name('detalle_mascota');
			Route::prefix('/editar')->group(function(){
				Route::get('/', 'MascotasController@edit')->name('editar_mascota');
				Route::put('/', 'MascotasController@saveOrUpdateData')->name('editar_mascota.post');
			});
		});
	});
	Route::prefix('/solicitudes')->group(function(){
		Route::get('/', 'SolicitudesController@list')->name('listar_solicitudes');
		Route::prefix('/crear')->group(function(){
			Route::get('/', 'SolicitudesController@new')->name('crear_solicitud');
			Route::post('/', 'SolicitudesController@saveOrUpdateData')->name('crear_solicitud.post');
		});
		Route::prefix('/{solicitud}')->group(function(){
			Route::get('/', 'SolicitudesController@detail')->name('detalle_solicitud');
			Route::prefix('/editar')->group(function(){
				Route::get('/', 'SolicitudesController@edit')->name('editar_solicitud');
				Route::put('/', 'SolicitudesController@saveOrUpdateData')->name('editar_solicitud.post');
			});
			Route::prefix('/revisiones')->group(function(){
				Route::post('/', 'RevisionesController@save')->name('crear_revision.post');
			});
		});
	});
	Route::prefix('/perfil')->group(function(){
		Route::get('/', 'UsersController@profile')->name('perfil');
		Route::prefix('/cambiar-credencial')->group(function(){
			Route::get('/', 'UsersController@changePassword')->name('cambiar_password');
			Route::post('/', 'UsersController@updatePassword')->name('cambiar_password.post');
		});
		Route::prefix('/{user}')->group(function(){
			Route::get('/editar', 'UsersController@edit')->name('editar_perfil');
		});
	});
});