<?php

    class ccimarketplace{

    	/*private static $db_host = "172.30.5.15\BDPRUCCI01";
    	private static $db_name = "dbMarketplaceColombia";
    	private static $db_user = "UserPruebasAsis";
    	private static $db_pass = "CCiPruebasAsis";*/

    	private static $db_host = "172.30.5.14\BDCCI01";
    	private static $db_name = "dbMarketplaceColombia";
    	private static $db_user = "admin_soporte";
    	private static $db_pass = "Acceso2019";

    	private static $cont = null;

		public static function connect(){

			if(self::$cont == null){
				try{
					self::$cont = new PDO("sqlsrv:Server=".self::$db_host.";"."Database=".self::$db_name, self::$db_user, self::$db_pass);
					self::$cont-> exec("SET CHARACTER SET utf8");
				}catch(PDOException $e){
					die($e->getMessage());
				}
			
			}
			return self::$cont;
		}

		public static function disconnect(){
			self::$cont=null;
		}
	}
?>