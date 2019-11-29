<?php 
	use src\Core\Route;

	 // 모든 유저들이 갈수있는 경로
	Route::reg([
		["get","/@MainController@main"],
		// ['method_name', '/linkname@className@function_name']
	]);
	if(ss()){ // login한 유저들만 갈수있는 경로
		Route::reg([

		]);
	}else{ // login안한 유저들만 갈수있는 경로
		Route::reg([
			["post","/action/insert@MainController@insert"],
			["get","/action/update@MainController@update"],
		]);
	}