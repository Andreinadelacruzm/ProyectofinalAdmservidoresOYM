<?php
check_user('miscompras');
$s = $mysqli->query("SELECT * FROM compra WHERE id_cliente = '".$_SESSION['id_cliente']."' ORDER BY fecha DESC");
if(mysqli_num_rows($s)>0){
	?>
	<h1>Mis compras</h1>

	<table class="table table-stripe">
		<tr>
			<th>Fecha</th>
			<th>Monto</th>
			<td>Estado</td>
			<td>Acciones</td>
		</tr>

	<?php
	while($r=mysqli_fetch_array($s)){
		?>
		<tr>
			<td><?=fecha($r['fecha'])?></td>
			<td><?=number_format($r['monto'])?> <?=$divisa?></td>
			<td><?=estado($r['estado'])?></td>
			<td>
				<a href="?p=ver_compra&id=<?=$r['id']?>">
					<i class="fa fa-eye"></i>
				</a>

				<?php
					if(estado($r['estado']) == "Iniciando"){
						?>
							&nbsp; &nbsp; <a title="Pagar" href="?p=pagar_compra&id=<?=$r['id']?>"><b>P</b></a>
						<?php
					}
				?>
			</td>
		</tr>
		<?php
	}
	?>
	</table>

	<?php
}else{
	?>
	<i>Usted aun no ha comprado</i>
	<?php
}