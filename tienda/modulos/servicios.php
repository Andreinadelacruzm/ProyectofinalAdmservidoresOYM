<?php 
?>
	<form method="post" action="">
		<div class="row">
      <h1 align="center">CONTACTO</h1>
      <h3 align="center">Solicitar cotización o mas información</h3>

     
			<div class="col">
				<div class="form-group">
					<input type="text" class="form-control" name="busq" placeholder="Nombre Completo:"/>
				</div>

                <div class="col">
				<div class="form-group">
					<input type="text" class="form-control" name="busq" placeholder="Tipo de Servicio/Producto:"/>
				
                </div>

                <div class="col">
				<div class="form-group">
					<input type="text" class="form-control" name="busq" placeholder="Nombre de la Empresa:"/>
				</div>
			</div>
            <div class="col">
				<div class="form-group">
					<input type="text" class="form-control" name="busq" placeholder="Correo electronico (requerido):"/>
				
                </div>
			
            <div class="col">
				<div class="form-group">
					<input type="text" class="form-control" name="busq" placeholder="Telefono o Celular:"/>
				</div>
			</div>
            </div>
            <button type="submit" align="center" onclick='alert("Solicitud Enviada")' class="btn btn-success" name="buscar"> Enviar</button>
		</div>
	</form>
<?php
?>