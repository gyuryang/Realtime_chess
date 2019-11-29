<?php 
	namespace src\Core;
	/**
	 * Router
	 */
	class Route
	{
		static $GET= []; // get link
		static $POST= []; // post link

		static function init (){ // router initial
			$get = isset($_GET['url'])? "/".$_GET['url']: "/"; // get url
			// if($get != $_SERVER['REQUEST_URI']) // 경로에 띄어쓰기 있는지 체크
			// 	move("/", "잘못된 접근");
			foreach (self::${$_SERVER["REQUEST_METHOD"]} as $v) { // link foreach
				$v= explode("@", $v);
				// '/@MainController@main'
				// $v
				// 0 => url
				// 1 => Controller Name
				// 2 => Function Name
				$reg= preg_replace("/:([^\/]+)/", "([^/]+)", $v[0]);
				$reg= preg_replace("/\//", "\\/", $reg);
				// echo $_GET['url'];
				if(preg_match("/^".$reg."$/", $get, $p)){
				// if($v[0] == $get){
					$src= "src\\Controller\\".$v[1];
					// var_dump($src);
					$src= new $src();
					// var_dump($src);
					// var_dump($v);
					$src->{$v[2]}($p);
					exit;
				}
			}
			// move("/", "잘못된 접근");
		}
		static function reg($arr){ // router register
			foreach ($arr as $key => $v) {
				self::${strtoupper($v[0])}[]= $v[1]; // add link
			}
		}

}