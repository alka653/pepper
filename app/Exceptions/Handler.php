<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler{
	protected $dontReport = [];
	protected $dontFlash = [
		'password',
		'password_confirmation',
	];
	public function report(Exception $exception){
		parent::report($exception);
	}
	public function render($request, Exception $exception){
		if($request->ajax() || $request->wantsJson()){
			$json = [
				'success' => false,
				'error' => [
					'code' => $exception->getCode(),
					'message' => $exception->getMessage(),
				],
			];
			return response()->json($json, 400);
		}
		return parent::render($request, $exception);
	}
}
