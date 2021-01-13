<?php

Class Conexion{

	static public function conectar(){

		$link = new PDO("mysql:host=localhost;dbname=reservas-hotel-copia",
						"root",
						"");

		$link->exec("set names utf8");

		return $link;

	}


}