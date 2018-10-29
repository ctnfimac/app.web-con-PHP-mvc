<?php

$promocion = '
<div class="grey lighten-3 py-5 mb-5" id="content-01" style="background: linear-gradient(90deg, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0)),url(\'img/home/promocion/promocion01.jp\') center center; background-size: cover;">
	<div class="container d-flex flex-column" style="max-height: 800px;">
		<div class="row my-auto">
			<figure class="figure m-auto">
				<img src="%s" class="figure-img img-fluid z-depth-1" alt="..." style="width: 500px">
			</figure>
			<div class="col-lg-4 col-md-10 col-sm-12 m-auto py-4 pt-5">
				<p class="display-4 mb-0 pb-0" style="font-size: 2.4em">Plato Del Día</p>
				<hr class="my-4">
				<p class="lead pb-4">%s</p>
				<span class="text-in float-right p-1 block-example" style="font-size: 2em">$%s</span>

				<a class="btn btn-deep-orange btn-lg waves-effect waves-light" href="index.php?route=home&operacion=agregar&id='.$menuDelDia->getId().'">Agregar
					<i class="fa fa-shopping-cart ml-3"></i>
				</a>
			</div>
			
		</div>
	</div>
</div>
';