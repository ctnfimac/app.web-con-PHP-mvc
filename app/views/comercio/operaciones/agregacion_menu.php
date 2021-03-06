<?php
echo'
	<div class="container mt-4">
		<div class="row justify-content-center">
			<div class="col-xs-12 col-md-6 ">
				<div class="card p-4">
				<h2 class="text-center text-success">Agregar un nuevo Menu</h2>
				<form action="index.php?route=comercio&opcion=menu&operacion=agregar" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label for="descripcion">Descripcion</label>
						<input type="text" class="form-control" name="descripcion" placeholder="descripcion" required>
					</div>
					<div class="form-group">
						<label for="precio">Precio</label>
						<input type="text" class="form-control" name="precio" placeholder="precio" required>
					</div>
					<div class="form-group">
						<label for="imgurl">Imagen</label>
						<div class="custom-file">
							<input type="file" class="custom-file-input" name="fileImagen" id="fileImagen" aria-describedby="inputGroupFileAddon01" required>
							<label class="custom-file-label" for="fileImagen">Elija Imágen</label>
						</div>
					</div>
					<input type="submit" value="Agregar" class="btn btn-md btn-primary">
					<a class="btn bg-warning text-white" href="index.php?route=comercio&tabla=menus">Cancelar</a>
				</form>
				</div>
			</div>
		</div>
	</div>
';