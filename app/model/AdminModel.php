<?php

class AdminModel extends Conexion{
	private $seccion = 'home';

	public function buscarUsuario($email,$pass){
		//$matriz = array();
		$admin_nombre = false;
		$this->query = 
				"SELECT * 
				 FROM usuario
				 WHERE email = '$email' AND contrasenia = '$pass' LIMIT 1";
		$tabla = $this->get_query();
		while($fila = $tabla->fetch_assoc()){
			$admin_nombre = $fila['nombre'];
			$this->setSeccion($fila['id']);
		}
		return $admin_nombre;
	}

	public function getSeccion(){
		return $this->seccion;
	}

	private function setSeccion($id){
		// $clienteModel = new ClienteModel();
		// $clienteModel->query = "SELECT * FROM cliente WHERE id_usuario = '$id'";
		// if($clienteModel->get_query() != null) {
		// 	$this->seccion = 'cliente';
		// 	return;
		// }

		$this->seccion = 'admin';	
		$_SESSION['usuario'] = 'admin';

		$comercioModel = new ComercioModel();
		$comercioModel->query = "SELECT * FROM comercio WHERE id_comercio = '$id'";
		$tabla = $comercioModel->get_query() ;
		//echo 'antes';
		while($fila = $tabla->fetch_assoc()) {
			$this->seccion = 'comercio';
			$_SESSION['usuario'] = 'comercio';
		}

		$repartidorModel = new RepartidorModel();
		$repartidorModel->query = "SELECT * FROM repartidor WHERE id_usuario = '$id'";
		$tabla = $repartidorModel->get_query() ;
		//echo 'antes';
		while($fila = $tabla->fetch_assoc()) {
			$this->seccion = 'repartidor';
			$_SESSION['usuario'] = 'repartidor';
			//$repartidorModel = new RepartidorModel();
			//$repartidorModel->activar();
		}

		$clienteModel = new ClienteModel();
		$clienteModel->query = "SELECT * FROM cliente WHERE id_usuario = '$id'";
		$tabla = $clienteModel->get_query() ;
		//echo 'antes';
		while($fila = $tabla->fetch_assoc()) {
			$this->seccion = 'cliente';
			$_SESSION['usuario'] = 'cliente';
		}
	}

	public function alta(){
		
	}
	public function baja(){

	}
	public function modificacion(){

	}
}