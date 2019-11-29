<?php 
	namespace src\Controller;
	/**
	 * MainController
	 */
	use src\Core\DB;
	class MainController
	{
		public function main (){
			view("main", []);
		}

		public function update(){
			header('Content-Type: text/html; charset=utf-8');

			$conn = mysqli_connect('localhost', 'root', '', 'chess') or die ('Error connecting to mysql');
			$sql = "SELECT * FROM chessboard";
			$result = mysqli_query($conn, $sql);

			while($row = mysqli_fetch_array($result)){
					$array[] = $row;
			}
			
			mysqli_close($conn);
			
			echo json_encode($array);
		}

		public function insert(){
			$arr = $_POST['arr'];
			$piece = isset($_POST['thispiece'])? $_POST['thispiece'] : '';
			var_dump($_POST);

			if($_POST["DML"] == 'insert'){
				DB::exec("DELETE FROM chessboard",[]);
				DB::exec("INSERT INTO chessboard SET whiterook=?, whiteknight=?, whitebishop=?, whiteking=?, whitequeen=?,whitepawn=?,blackrook=?, blackknight=?,blackbishop=?,blackking=?,blackqueen=?,blackpawn=?",[$arr['whiterook'],$arr['whiteknight'],$arr['whitebishop'],$arr['whiteking'],$arr['whitequeen'],$arr['whitepawn'],$arr['blackrook'],$arr['blackknight'],$arr['blackbishop'],$arr['blackking'],$arr['blackqueen'],$arr['blackpawn']]);
			}else{
				DB::exec("UPDATE chessboard SET $piece=?",[$arr[$piece]]);
			}
		}
	}