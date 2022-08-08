<?php

	class DatabaseHelper{

		private static $servername = 'localhost';
		private static $username = 'root';
		private static $password = '';
		private static $dbname = 'bookstore';

		public static $conn;

		/**		
		* Creates connection if null
		* 
		*
		* 
		* @return Void
		**/

		public static function init(){			
			if (self::$conn == null){							
				try{
					self::$conn = new PDO("mysql:host=".self::$servername.";dbname=".self::$dbname.";", self::$username, self::$password);
					self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);					
				}catch (Exception $ex){
					echo $ex;
				}				
			}
		}		
	}
