<?php
check_admin();

if(isset($enviar)){
	$name = clear($name);
	$price = clear($price);
	$oferta = clear($oferta);

	$imagen = "";
	$descargable = "";

	if(is_uploaded_file($_FILES['imagen']['tmp_name'])){
		$imagen = $name.rand(0,1000).".png";
		move_uploaded_file($_FILES['imagen']['tmp_name'], "../productos/".$imagen);
	}

	if(is_uploaded_file($_FILES['descargable']['tmp_name'])){
		$descargable = rand(0,1000).$_FILES['descargable']['name'];
		move_uploaded_file($_FILES['descargable']['tmp_name'], "../descargable/".$descargable);
	}
	// if($categoria = 'Tecnologia')
	// {
	// 	$categoriaID = 2;
	// }
	// else if($categoria = 'Limpieza')
	// {
	// 	$categoriaID = 3;
	// }
	// else if($categoria = 'Servicios de Diseño y Organización')
	// {
	// 	$categoriaID = 4;
	// }

	$mysqli->query("INSERT INTO productos (name,price,imagen,oferta,id_categoria,descargable) VALUES ('$name','$price','$imagen',$oferta,'$categoria','$descargable')");
	//alert("Producto agregado");
	redir("?p=agregar_producto");
}

if(isset($eliminar)){
	$mysqli->query("DELETE FROM productos WHERE id = '$eliminar'");
	redir("?p=agregar_producto");
}


?>

<h1>Agregar Producto</h1><br><br>

<form method="post" action="" enctype="multipart/form-data">
	<div class="form-group">
		<input type="text" class="form-control" name="name" placeholder="Nombre del producto"/>
	</div>


	<div class="form-group">
		<input type="text" class="form-control" name="price" placeholder="Precio del producto"/>
	</div>


	<label>Imagen del producto</label>

	<div class="form-group">
		<input type="file" class="form-control" name="imagen" title="Imagen del producto" placeholder="Imagen del producto"/>
	</div>

	<div class="form-group">

		<select name="categoria" required class="form-control">
			<option value="">Seleccione una categoria</option>
			<?php
				$q = $mysqli->query("SELECT * FROM categorias ORDER BY categoria ASC");

				while($r=mysqli_fetch_array($q)){
					?>
						<option value="<?=$r['id']?>"><?=$r['categoria']?></option>
					<?php
				}
			?>
		</select>

	</div>

	<div class="form-group">
		<select name="oferta" class="form-control">
			<option value="0">0% de Descuento</option>
			<option value="5">5% de Descuento</option>
			<option value="10">10% de Descuento</option>
			<option value="15">15% de Descuento</option>
			<option value="20">20% de Descuento</option>
			<option value="25">25% de Descuento</option>
			<option value="30">30% de Descuento</option>
			<option value="35">35% de Descuento</option>
			<option value="40">40% de Descuento</option>
			<option value="45">45% de Descuento</option>
			<option value="50">50% de Descuento</option>
			<option value="55">55% de Descuento</option>
			<option value="60">60% de Descuento</option>
			<option value="65">65% de Descuento</option>
			<option value="70">70% de Descuento</option>
			<option value="75">75% de Descuento</option>
			<option value="80">80% de Descuento</option>
			<option value="85">85% de Descuento</option>
			<option value="90">90% de Descuento</option>
			<option value="95">95% de Descuento</option>
			<option value="99">99% de Descuento</option>
		</select>
	</div>

	<div class="form-group">
		<label>¿Tiene algun archivo de descarga?</label>
		<input class="form-control" type="file" name="descargable"/>
	</div>


	<div class="form-group">
		<button type="submit" class="btn btn-success" name="enviar"><i class="fa fa-check"></i> Agregar Producto</button>
	</div>

</form><br>

<br>

<table class="table table-striped">

	<tr>
		<th>Nombre</th>
		<th>Precio</th>
		<th>Descuento</th>
		<th>Precio Total</th>
		<th>Imagen</th>
		<th>Categoria</th>
		<th>Acciones</th>
	</tr>

	<?php
		$prod = $mysqli->query("SELECT * FROM productos ORDER BY id DESC");
		while($rp=mysqli_fetch_array($prod)){
			$preciototal = 0;

			$cat = $mysqli->query("SELECT * FROM categorias WHERE id = '".$rp['id_categoria']."'");

			if(mysqli_num_rows($cat)>0){
				$rcat = mysqli_fetch_array($cat);
				$categoria = $rcat['categoria'];
			}else{
				$categoria = "--";
			}

			if($rp['oferta']>0){
				if(strlen($rp['oferta'])==1){
					$desc = "0.0".$rp['oferta'];
				}else{
					$desc = "0.".$rp['oferta'];
				}

				$preciototal = $rp['price'] -($rp['price'] * $desc);
			}else{
				$preciototal = $rp['price'];
			}



			?>
				<tr>
					<td><?=$rp['name']?></td>
					<td><?=$rp['price']?></td>
					<td>
						<?php
							if($rp['oferta']>0){
								echo $rp['oferta']."% de Descuento";
							}else{
								echo "Sin descuento";
							}
						?>
					</td>

					<td><?=$preciototal?></td>

					<td><img src="../productos/<?=$rp['imagen']?>" class="imagen_carro"/></td>
					<td><?=$categoria?></td>
					<td>
						
						<a style="color:#08f" href="?p=modificar_producto&id=<?=$rp['id']?>"><i class="fa fa-edit"></i></a>
						&nbsp;
						<a style="color:#08f" href="?p=agregar_producto&eliminar=<?=$rp['id']?>"><i class="fa fa-times"></i></a>

					</td>
				</tr>
			<?php
		}
	?>

</table>