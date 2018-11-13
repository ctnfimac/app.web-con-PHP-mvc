<?php

require_once('class/Pedido.php');

class PedidoModel extends Conexion{

	private $operacion;

	protected function alta(){
		//obtener id del comercio
		$menu = new MenuModel();
		foreach($_SESSION['carrito'] as $key => $value){
			$id_comercio = $menu->buscoIdDeComercioPorMenu($value['id']);
		}
		//obtener id del cliente
		$cliente = new ClienteModel();
		$id_cliente =  $cliente->buscarIdPorNombre($_SESSION['admin']);

		$precio = $_GET['precio_total'];
		//setear al repartidor cuando este acepte hacer la entrega

		$fecha = date("Y-m-d H:i:s",time());
		$date = new DateTime($fecha, new DateTimeZone('America/Argentina/Buenos_Aires'));
		date_default_timezone_set('America/Argentina/Buenos_Aires');
		$zonahoraria = date_default_timezone_get();
		//$fecha=date("Y-m-d H:i:s",time());
		$dia = date("Y-m-d",time());
		$hora = date("H:i:s",time());
		//completar la tabla pedido
		$this->query = "INSERT INTO pedido(id_comercio,id_cliente,fecha_alta, hora_alta, precio)
						VALUES ('$id_comercio','$id_cliente',CURDATE(), '$hora' , '$precio')";
		$this->set_query();

		
		
		$this->query = "SELECT id 
						FROM pedido 
						WHERE fecha_alta = '$dia' AND hora_alta = '$hora' 
							  AND id_comercio = '$id_comercio' AND id_cliente='$id_cliente'";
		$tabla = $this->get_query();
		while($row = $tabla->fetch_assoc()){
			$id_pedido = $row['id'];
		}

		// por cada menu agregar el menu y el id del menu
		foreach($_SESSION['carrito'] as $key => $value){
			$id_menu = $value['id'];
			$cantidad = $value['cantidad'];
			$this->query = "INSERT INTO pedido_menus(id_pedido,id_menu,cantidad)
							VALUES ('$id_pedido','$id_menu','$cantidad')";
			$this->set_query();
		}
		$_SESSION['carrito'] = null;
		header('location:index.php?route=carrito');
		//iniciar timer para la penalizacion
	}

	protected function baja(){}
	protected function modificacion(){}

		

	public function setOperacion($operacion){
		$this->operacion = $operacion;
	}

	public function ejecutarOperacion(){
		$id = isset($_GET['id'])? $_GET['id'] : 'sin setear';
		$resultado = $this->operacion;
		
		switch($this->operacion){
			case 'agregar':
				$this->alta();
				$resultado = '';
				break;
			case 'eliminar':
				$this->baja($id);
				$resultado = '';
				break;
			case 'modificar':
				$this->modificacion($id);
				$resultado = '';
				break;
			default :
				//echo 'no hago nada';
				break;
		}
		return $resultado;
	}

	public function mostrarPedidos(){
		$matriz = array();
		$contador = 0;

		$this->query = "SELECT id, id_comercio, id_cliente, fecha_alta, hora_alta, id_repartidor ,precio, estado
						FROM pedido";
							 
		$tabla = $this->get_query();
		while($fila = $tabla->fetch_assoc()){
			 $pedido = new Pedido($fila['id'],$fila['id_comercio'],$fila['id_cliente'],$fila['fecha_alta'],
			 				  $fila['hora_alta'],$fila['id_repartidor'],$fila['precio'],$fila['estado']);
			 $matriz[$contador] = $pedido;
			 $contador++;
		}
		return $matriz;
	}

	public function mostrarPedidosPorComercio(){
		$matriz = array();
		$contador = 0;
		
		$comercio = $_SESSION['admin'];
		$this->query = "SELECT id, id_comercio, id_cliente, fecha_alta, hora_alta, id_repartidor ,precio
						FROM pedido
						WHERE id_comercio = (select id from usuario where nombre = '$comercio')";
							 
		$tabla = $this->get_query();
		while($fila = $tabla->fetch_assoc()){
			 $pedido = new Pedido($fila['id'],$fila['id_comercio'],$fila['id_cliente'],$fila['fecha_alta'],
			 				  $fila['hora_alta'],$fila['id_repartidor'],$fila['precio']);
			 $matriz[$contador] = $pedido;
			 $contador++;
		}
		return $matriz;
	}

	public function mostrarPedidosPorCliente(){
		$matriz = array();
		$contador = 0;
		
		$cliente = $_SESSION['admin'];
		$this->query = "SELECT id, id_comercio, id_cliente, fecha_alta, hora_alta, id_repartidor ,precio
						FROM pedido
						WHERE id_cliente = (select id from usuario where nombre = '$cliente')";
							 
		$tabla = $this->get_query();
		while($fila = $tabla->fetch_assoc()){
			 $pedido = new Pedido($fila['id'],$fila['id_comercio'],$fila['id_cliente'],$fila['fecha_alta'],
			 				  $fila['hora_alta'],$fila['id_repartidor'],$fila['precio']);
			 $matriz[$contador] = $pedido;
			 $contador++;
		}
		return $matriz;
	}

	public function getMenuDePedido($id_pedido){
		$matriz = array();
		$contador = 0;
		$this->query = "SELECT m.id, m.descripcion, m.imagen, m.precio , m.id_comercio, pm.cantidad
						FROM pedido_menus pm JOIN
							 pedido p ON pm.id_pedido = p.id JOIN
							 menu m ON m.id = pm.id_menu
						WHERE p.id = '$id_pedido'";				 
		$tabla = $this->get_query();
		while($fila = $tabla->fetch_assoc()){
			 $menu = new Menu($fila['id'],$fila['descripcion'],$fila['imagen'],$fila['precio'],
			 				  $fila['id_comercio'],$fila['cantidad']);
			 $matriz[$contador] = $menu;
			 $contador++;
		}
		return $matriz;
	}

	public function estadoPedidoTomar($id_pedido){
		$repartidor = $_SESSION['admin'];
		$this->query = "UPDATE pedido SET estado = 2, id_repartidor = (SELECT id FROM usuario WHERE nombre = '$repartidor' ) 
						WHERE id = '$id_pedido'";
		$this->set_query();
	}

	public function estadoPedidoCancelar($id_pedido){
		$this->query = "UPDATE pedido SET estado = 1, id_repartidor = null 
						WHERE id = '$id_pedido'";
		$this->set_query();
	}

	public function estadoPedidoFinalizar($id_pedido){
		$this->query = "UPDATE pedido SET estado = 3 
						WHERE id = '$id_pedido'";
		$this->set_query();
	}
}