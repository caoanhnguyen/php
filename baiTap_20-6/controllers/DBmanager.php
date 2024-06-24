<?php
	class DBmanager{
		private $server_name = 'localhost';
		private $user_name = 'root';
		private $passwd = '12345A@a';
		private $db_name = 'ct060102';
	
		private static $connect;

		public static function getConnection(){
			if(self::$connect === null){
				self::$connect = new MySQLi('localhost','root','12345A@a','ct060102');

				if(self::$connect->connect_error){
					die("Connect failed!");
				}
			}
			return self::$connect;
		}

		public static function closeConnection(){
			if(self::$connect !==null){
				self::$connect->close();
				self::$connect = null;
			}
		}
	}
?>