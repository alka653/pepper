<?php

namespace App\Http\Controllers;

use App\UserLog;
use Illuminate\Http\Request;

class LogController extends Controller{
    const DIR_TEMPLATE = 'log.';
    public function list(Request $request){
        $logs = new UserLog();
		return view(self::DIR_TEMPLATE.'list', [
			'logs' => $logs->paginate(10)
		]);
	}
}