<?php

//incluimos la base de datos
 include_once("includes/db.php");
 //instanciamos la clase DB
 $DB = new DB();

//realizamos una consulta a la base de datos para traer los datos de los productos
  $producto = $DB->connect()->prepare("SELECT ID, id_ventas, Nombre_Producto, Precio, Cantidad_venta FROM ventas INNER JOIN productos ON ventas.fk_producto = Productos.ID WHERE 1");
 $producto->execute();

//se evalua si existe submit para empezar a evaluar el registro de la venta
 if (isset($_POST['submit'])) {
 	 $id = $_POST['id'];
 	 $cantidad = $_POST['cantidad'];
 	 //se realiza una consulta para saber la cantidad de productos en stock
 	 $consulta = $DB->connect()->prepare("SELECT ID, Stock FROM productos WHERE ID = :id");
 	 $consulta->bindParam(":id", $id);
 	 $consulta->execute();
 	 $venta = $consulta->fetchAll(PDO::FETCH_ASSOC);
 	 
 //se evalua si la consulta anterior tiene registros
 	 if ($venta) {

 	 	$id_venta = $venta[0]['Stock'];
 	    $venta_cantidad = $cantidad;
 	  //Se evalua si la cantidad comprada supera la cantidad de productos en stock
 	 	if (($id_venta - $venta_cantidad) >= 0) {
 	 //si la cantidad de productos comprados no supera la cantidad de articulos en stock entonces se actualiza la cantidad en stock y agrga la cantidad comprada a la tabla ventas
 	 	$total = $id_venta - $venta_cantidad;
        $actualizar = $DB->connect()->prepare('UPDATE `productos` SET `Stock`= :stock WHERE ID = :id ');
 	 	 $actualizar->bindParam(":id", $id);
 	 	 $actualizar->bindParam(":stock", $total);
 	 	 $actualizar->execute();

        $cargar = $DB->connect()->prepare("INSERT INTO `ventas`( `Cantidad_venta`, `fk_producto`) VALUES (:cantidad,:producto)");
        $cargar->bindParam(":cantidad", $cantidad);
        $cargar->bindParam(":producto", $id);
        $cargar->execute();
        echo "<script>alert('Venta registrada'); location.href = 'venta.php';</script>";
        

 	 }else if($venta[0]['Stock'] == 0){ //Se evalua si la cantidad de productos en stock es igual a cero
        echo "<script>alert('No hay productos en stock '); location.href = 'venta.php';</script>";
 	 }else{ //si la resta entre la cantidad comprada y la cantidad de articulos en stock da menos de cero entonces no se realiza la venta
 	 	echo "<script>alert('La cantidad supera el stock '); location.href = 'venta.php';</script>";
 	 }

 	 }else{//se informa al usuario en caso de que el id no exista
 	 	echo "<script>alert('no existe este producto'); location.href = 'venta.php';</script>";
 	 };

//se cierran las consultas realizadas 
 	 $cargar->closeCursor(); 
	 $cargar = null; 
	 $consulta->closeCursor(); 
	 $consulta = null;
	 $actualizar->closeCursor(); 
	 $actualizar = null;  
 	 
 }

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
	<title>Ventas</title>
</head>
<body>

	<?php include_once("viws/navbar.php"); ?>

<br>
<h2 class="text-center">REGISTRAR VENTA</h2>
  <form action="" method="POST"  style="width:80%; margin-right: auto;margin-left: auto;">
  <div class="form-group">
    <label for="id">ID producto</label>
    <input type="number" class="form-control" id="id" placeholder="id" name="id">
  </div>
  
  <div class="form-group">
    <label for="cantidad">Cantidad vendida</label>
    <input class="form-control" id="cantidad"  placeholder="cantidad vendida" name="cantidad">
  </div>
  <button type="submit" name="submit" class="btn btn-primary">ENVIAR</button>
</form>

<br>
<hr>
<h2 class="text-center">VER VENTAS</h2>

<div class="row" style="width:100%;">
	<div class="col-12 text-center">
		<p>
  <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseWidthExample" aria-expanded="false" aria-controls="collapseWidthExample">
    Ventas
  </button>
</p>
<div style="min-height: 120px;">
  <div class="collapse width " id="collapseWidthExample">
    <div class="card card-body " style="width: 100%;">
      <table class="table table-responsive text-center">
		  <thead>
		    <tr>
		      <th scope="col">ID_venta</th>
		      <th scope="col">ID_producto</th>
		      <th scope="col">Nobre producto</th>
		      <th scope="col">Precio</th>
		      <th scope="col">Cantidad vendida</th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php foreach ($producto as  $value):?>
		    <tr>
		      <th scope="row"><?php echo $value['id_ventas']; ?></th>
		      <td scope="row"><?php echo $value['ID']; ?></td>
		      <td scope="row"><?php echo $value['Nombre_Producto']; ?></td>
		      <td scope="row"><?php echo $value['Precio']; ?></td>
		      <td scope="row"><?php echo $value['Cantidad_venta']; ?></td>
		    </tr>
		<?php endforeach;
		 $producto->closeCursor(); 
		 $producto = null; 

		 ?>
		    
		  </tbody>
		</table>
    </div>
  </div>
</div>
	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>
</html>
