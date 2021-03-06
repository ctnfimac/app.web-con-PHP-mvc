<?php

require_once('Usuario.php');

class Repartidor extends Usuario{
	private $id_usuario;
	private $fecha_nacimiento;
	private $dni;
	private $cuil;
	private $estado;
	// private $id_usuario;

	public function __construct($id,$nombre,$apellido,
				$email,$contrasenia,$telefono,$fecha_nacimiento,$dni,$cuil,$habilitado,$estado){
		parent::__construct($id,$nombre,$apellido,$email,$contrasenia,$telefono,$habilitado);
		$this->id_usuario = $id;
		$this->fecha_nacimiento = $fecha_nacimiento;
		$this->dni = $dni;
		$this->cuil = $cuil;
		$this->estado = $estado;
	}

	public function getIdUsuario(){
		return $this->id_usuario;
	}

	public function getFechaNacimiento(){
		return $this->fecha_nacimiento;
	}

	public function getDni(){
		return $this->dni;
	}

	public function getCuil(){
		return $this->cuil;
	}
	public function getEstado(){
		return $this->estado;
	}
}