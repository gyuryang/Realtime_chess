<?php 
	function auto($f){ // autoloader
		require "$f.php";
	}
	spl_autoload_register("auto");

	function alert($t){ // alert
		echo "<script>alert('$t');</script>";
	}
	function back($t= ""){ // back function 
		if(!empty($t))
			alert($t);
		echo "<script>history.back();</script>";
		exit;
	}
	function move($l, $t= ""){ // move function
		if(!empty($t))
			alert($t);
		echo "<script>location.replace('$l');</script>";
		exit;
	}
	
	function view($f, $d){ // view function 
		extract($d);
		if($f == 'main'){
			require "src/View/$f.php";
		}else{
			$f= explode("/", $f);
			// user/login
			require "src/View/$f[0]/$f[1].php";
		}
	}
	function ss(){
		return isset($_SESSION['user'])? $_SESSION['user']: false;
	}



















