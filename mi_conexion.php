<?php 
	class Database{
		private $host = "bkimoubsobiui6hx4jy3-mysql.services.clever-cloud.com";
		private $db = "bkimoubsobiui6hx4jy3";
		private $usuario = "udfnbb2a7hpjmw6n";
		private $clave = "0Exh3mlyDnOtZHnGU48M";
		private $charset ="utf8";

		function conectar(){
			try{
				$conexion = "mysql:host=" . $this->host . "; dbname=" . $this->db . "; charset=" . $this->charset;
				$options = [
					PDO::ATTR_ERRMODE => PDO ::ERRMODE_EXCEPTION,
					PDO::ATTR_EMULATE_PREPARES=> false
				];
				$pdo = new PDO($conexion, $this->usuario,$this->clave, $options);
				return $pdo;
			}catch(PDOException $e){
				echo 'Error conexion: '.$e;
				exit;
			}

		}
		
	}
											