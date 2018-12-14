<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller{
	const DIR_TEMPLATE = 'home.';
	public function index(){
		return view(self::DIR_TEMPLATE.'index');
	}
}