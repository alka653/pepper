<?php

Route::get('/', 'HomeController@index')->name('home');
Route::get('/ley', function(){
	return view('home.law');
})->name('ley_746');
Route::get('/quienes-somos', function(){
	return view('home.about');
})->name('quienes_somos');
Route::get('/acerda-de', function(){
	return view('home.acerca_de');
})->name('acerca');
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
			Route::get('/', 'MascotasController@new')->name('crear_mascota')->middleware('permission:crear_mascota');
			Route::post('/', 'MascotasController@saveOrUpdateData')->name('crear_mascota.post')->middleware('permission:crear_mascota.post');
		});
		Route::prefix('/{mascota}')->group(function(){
			Route::get('/', 'MascotasController@detail')->name('detalle_mascota')->middleware('check_own_pet');
			Route::group(['middleware' => 'check_own_pet', 'prefix' => 'editar'], function(){
				Route::get('/', 'MascotasController@edit')->name('editar_mascota');
				Route::put('/', 'MascotasController@saveOrUpdateData')->name('editar_mascota.post');
			});
		});
	});
	Route::prefix('/solicitudes')->group(function(){
		Route::get('/', 'SolicitudesController@list')->name('listar_solicitudes');
		Route::prefix('/crear')->group(function(){
			Route::get('/', 'SolicitudesController@new')->name('crear_solicitud')->middleware('permission:crear_solicitud');
			Route::post('/', 'SolicitudesController@saveOrUpdateData')->name('crear_solicitud.post')->middleware('permission:crear_solicitud.post');
		});
		Route::group(['prefix' => '{solicitud}', 'middleware' => 'check_id_user:solicitud'], function(){
			Route::get('/', 'SolicitudesController@detail')->name('detalle_solicitud');
			Route::prefix('/editar')->group(function(){
				Route::get('/', 'SolicitudesController@edit')->name('editar_solicitud')->middleware('permission:editar_solicitud');
				Route::put('/', 'SolicitudesController@saveOrUpdateData')->name('editar_solicitud.post')->middleware('permission:editar_solicitud.post');
			});
			Route::group(['prefix' => 'revisiones', 'middleware' => 'permission:crear_revision.post'], function(){
				Route::post('/{solicitud}', 'RevisionesController@saveOrUpdateData')->name('crear_revision.post');
				Route::prefix('/{revision}')->group(function(){
					Route::prefix('/editar')->group(function(){
						Route::get('/', 'RevisionesController@edit')->name('editar_revision');
						Route::put('/', 'RevisionesController@saveOrUpdateData')->name('editar_revision.post');
					});
				});
			});
		});
	});
	Route::prefix('/perfil')->group(function(){
		Route::get('/', 'UsersController@profile')->name('perfil');
		Route::prefix('/cambiar-credencial')->group(function(){
			Route::get('/', 'UsersController@changePassword')->name('cambiar_password');
			Route::post('/', 'UsersController@updatePassword')->name('cambiar_password.post');
		});
		Route::group(['prefix' => '{persona}', 'middleware' => 'check_id_user'], function(){
			Route::get('/', 'UsersController@profile')->name('perfil_usuario');
			Route::prefix('/editar')->group(function(){
				Route::get('/', 'UsersController@edit')->name('editar_perfil');
				Route::put('/', 'UsersController@updateData')->name('editar_perfil.post');
			});
		});
	});
	Route::prefix('/razas')->group(function(){
		Route::get('/lista', 'RazasController@listWithAuth')->name('listar_razas_with_auth')->middleware('permission:listar_razas');
		Route::prefix('/crear')->group(function(){
			Route::get('/', 'RazasController@new')->name('crear_raza')->middleware('permission:crear_raza');
			Route::post('/', 'RazasController@saveOrUpdateData')->name('crear_raza.post')->middleware('permission:crear_raza.post');
		});
		Route::prefix('{raza}')->group(function(){
			Route::prefix('/editar')->group(function(){
				Route::get('/', 'RazasController@edit')->name('editar_raza')->middleware('permission:editar_raza');
				Route::put('/', 'RazasController@saveOrUpdateData')->name('editar_raza.post')->middleware('permission:editar_raza.post');
			});
			Route::prefix('/eliminar')->group(function(){
				Route::get('/', 'RazasController@delete')->name('eliminar_raza')->middleware('permission:eliminar_raza');
				Route::delete('/', 'RazasController@deleteData')->name('eliminar_raza.delete')->middleware('permission:eliminar_raza.delete');
			});
		});
	});
	Route::prefix('/tipos-ataques')->group(function(){
		Route::get('/', 'TiposAtaquesController@list')->name('listar_tipos_ataques')->middleware('permission:listar_tipos_ataques');
		Route::prefix('/crear')->group(function(){
			Route::get('/', 'TiposAtaquesController@new')->name('crear_tipo_ataque')->middleware('permission:crear_tipo_ataque');
			Route::post('/', 'TiposAtaquesController@saveOrUpdateData')->name('crear_tipo_ataque.post')->middleware('permission:crear_tipo_ataque.post');
		});
		Route::prefix('{tipo_ataque}')->group(function(){
			Route::prefix('/editar')->group(function(){
				Route::get('/', 'TiposAtaquesController@edit')->name('editar_tipo_ataque')->middleware('permission:editar_tipo_ataque');
				Route::put('/', 'TiposAtaquesController@saveOrUpdateData')->name('editar_tipo_ataque.post')->middleware('permission:editar_tipo_ataque.post');
			});
			Route::prefix('/eliminar')->group(function(){
				Route::get('/', 'TiposAtaquesController@delete')->name('eliminar_tipo_ataque')->middleware('permission:eliminar_tipo_ataque');
				Route::delete('/', 'TiposAtaquesController@deleteData')->name('eliminar_tipo_ataque.delete')->middleware('permission:eliminar_tipo_ataque.delete');
			});
		});
	});
	Route::prefix('/localizaciones-anatomicas')->group(function(){
		Route::get('/', 'LocalizacionesAnatomicasController@list')->name('listar_localizaciones_anatomicas')->middleware('permission:listar_localizaciones_anatomicas');
		Route::prefix('/crear')->group(function(){
			Route::get('/', 'LocalizacionesAnatomicasController@new')->name('crear_localizacion_anatomica')->middleware('permission:crear_localizacion_anatomica');
			Route::post('/', 'LocalizacionesAnatomicasController@saveOrUpdateData')->name('crear_localizacion_anatomica.post')->middleware('permission:crear_localizacion_anatomica.post');
		});
		Route::prefix('{localizacion_anatomica}')->group(function(){
			Route::prefix('/editar')->group(function(){
				Route::get('/', 'LocalizacionesAnatomicasController@edit')->name('editar_localizacion_anatomica')->middleware('permission:editar_localizacion_anatomica');
				Route::put('/', 'LocalizacionesAnatomicasController@saveOrUpdateData')->name('editar_localizacion_anatomica.post')->middleware('permission:editar_localizacion_anatomica.post');
			});
			Route::prefix('/eliminar')->group(function(){
				Route::get('/', 'LocalizacionesAnatomicasController@delete')->name('eliminar_localizacion_anatomica')->middleware('permission:eliminar_localizacion_anatomica');
				Route::delete('/', 'LocalizacionesAnatomicasController@deleteData')->name('eliminar_localizacion_anatomica.delete')->middleware('permission:eliminar_localizacion_anatomica.delete');
			});
		});
	});
	Route::group(['middleware' => 'permission:modulo_ataques'], function(){
		Route::prefix('/propietarios')->group(function(){
			Route::get('/obtener', 'UsersController@getOwnerByNumDoc')->name('datos_propietario');
		});
		Route::prefix('/ataques')->group(function(){
			Route::get('/', 'AtaquesController@list')->name('listar_ataques');
			Route::prefix('/crear')->group(function(){
				Route::get('/', 'AtaquesController@new')->name('registrar_ataque');
				Route::post('/', 'AtaquesController@saveOrUpdateData')->name('registrar_ataque.post');
			});
			Route::prefix('/{ataque}')->group(function(){
				Route::get('/', 'AtaquesController@detail')->name('detalle_ataque');
				Route::prefix('/seguimiento')->group(function(){
					Route::get('/', 'AtaquesSeguimientosController@list')->name('seguimiento_ataque');
					Route::prefix('/crear')->group(function(){
						Route::get('/', 'AtaquesSeguimientosController@new')->name('crear_seguimiento_ataque');
						Route::post('/', 'AtaquesSeguimientosController@saveOrUpdateData')->name('crear_seguimiento_ataque.post');
					});
					Route::prefix('/{seguimiento}')->group(function(){
						Route::prefix('/editar')->group(function(){
							Route::get('/', 'AtaquesSeguimientosController@edit')->name('editar_seguimiento_ataque');
							Route::put('/', 'AtaquesSeguimientosController@saveOrUpdateData')->name('editar_seguimiento_ataque.post');
						});
						Route::prefix('/eliminar')->group(function(){
							Route::get('/', 'AtaquesSeguimientosController@delete')->name('eliminar_seguimiento_ataque');
							Route::delete('/', 'AtaquesSeguimientosController@deleteData')->name('eliminar_seguimiento_ataque.delete');
						});
					});
				});
			});
		});
	});
});
Route::prefix('/razas')->group(function(){
	Route::get('/', 'RazasController@listWithOutAuth')->name('listar_razas_without_auth');
	Route::get('/detalle/{raza}/{mode}', 'RazasController@detail')->name('detalle_raza_without_auth');
});