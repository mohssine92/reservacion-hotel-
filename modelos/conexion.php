<?php

Class Conexion{

	static public function conectar(){

		$link = new PDO("mysql:host=localhost;dbname=reservas-h",
						"root",
						"");

		$link->exec("set names utf8");

		return $link;

	}


}