<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportesController extends Controller{
	const DIR_TEMPLATE = 'reportes.';
	public function solicitudes(){
		return view(self::DIR_TEMPLATE.'solicitud', [
			'title' => 'Informe de solicitudes',
			'form' => [

			],
			'route' => 'reporte_solicitud_pdf'
		]);
	}
	public function solicitudesPDF(Request $request){
		if($request->busqueda != null){

		}
		return redirect()->route('reporte_solicitud');
	}
}