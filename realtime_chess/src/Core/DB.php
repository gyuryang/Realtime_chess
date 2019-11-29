<?php 
	namespace src\Core;
	/**
	 * DB class
	 */
	class DB
	{
		static $db;
		static function getDB(){ // get db
			if(is_null(self::$db))
				self::$db= new \PDO("mysql:host=localhost;charset=utf8mb4;dbname=chess", "root", "", [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION, \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ]);
			return self::$db;
		}
		static function exec($sql, $d){ // execute 쿼리문
			$row= self::getDB()->prepare($sql);
			try {
				$row->execute($d);
				return true;
			} catch (\Exception $e) {
				echo $e->getMessage();
				return false;
			}
		}
		static function fetch($sql, $d){  // fetch    select로 한개의 데이터만 가져올떄
			$row= self::getDB()->prepare($sql);
			$row->execute($d);
			return $row->fetch();
		}
		static function fetchAll($sql, $d){ // fetch All     select 된 모든 데이터를 가져올때
			$row= self::getDB()->prepare($sql);
			$row->execute($d);
			return $row->fetchAll();
		}
		static function lastInsertId(){ // get last Insert Ide
			return self::getDB()->lastInsertId();
		}
	}