<?php

if(isset($_GET['tabla']) && $_GET['tabla'] == 'menus'){
	require_once('admin/sections/menusTabla.php');
	printf($tablaMenus);	
}

elseif(isset($_GET['tabla']) && $_GET['tabla'] == 'clientes'){
	require_once('admin/sections/clientesTabla.php');
	printf($tablaClientes);
}

elseif(isset($_GET['tabla']) && $_GET['tabla'] == 'repartidores'){
	require_once('admin/sections/repartidorTabla.php');
	printf($tablaRepartidores);
}

elseif(isset($_GET['tabla']) && $_GET['tabla'] == 'comercios'){
	require_once('admin/sections/comerciosTabla.php');
	printf($tablaComercios);
}
elseif(isset($_GET['tabla']) && $_GET['tabla'] == 'solicitudes'){
	require_once('admin/sections/tablero.php');
	printf($tablero);
}else{
	require_once('admin/sections/tablero.php');
	printf($tablero);
}







	