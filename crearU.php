<?php
  
  include_once("includes/crear.php");
  $producto = new Productos();

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
	<title></title>
</head>
<body>

<?php include_once("viws/navbar.php");  ?>

<div class="row" style="margin: 0;">
	<div class="col-12 col-md-6 col-lg-6">
		<form action="" method="POST">
		  <div class="form-group">
		    <label for="Nombre">*Nombre</label>
		    <input type="text" class="form-control" id="Nombre" name="nombre" placeholder="Nombre" value="<?php echo isset($_POST['nombre']) ? $_POST['nombre'] : '' ?>">
		    <?php echo empty($_POST['nombre']) && isset($_POST['submit']) ? '<div class="alert alert-danger" role="alert">Campo nombre requerido</div>' : ''; 
		     ?>
		  </div>
	</div>
	<div class="col-12 col-md-6 col-lg-6">
		  <div class="form-group">
		    <label for="Referencia">*Referencia</label>
		    <input type="text" class="form-control" id="Referencia" name="referencia" placeholder="Referencia" value="<?php echo isset($_POST['referencia']) ? $_POST['referencia'] : '' ?>" >
		    <?php echo empty($_POST['referencia']) && isset($_POST['submit']) ? '<div class="alert alert-danger" role="alert">Campo referencia requerido</div>' : ''; 
		     ?>
		  </div>
	</div>
	<div class="col-12 col-md-6 col-lg-6">
		  <div class="form-group">
		    <label for="Precio">*Precio</label>
		    <input type="number" class="form-control" id="Precio" name="precio" placeholder="Precio" value="<?php echo isset($_POST['precio']) ? $_POST['precio'] : '' ?>" >
		    <?php echo empty($_POST['precio']) && isset($_POST['submit']) ? '<div class="alert alert-danger" role="alert">Campo precio requerido</div>' : ''; 
		     ?>
		  </div>
	</div>
	<div class="col-12 col-md-6 col-lg-6">
		  <div class="form-group">
		    <label for="Peso">*Peso en libras</label>
		    <input type="number" class="form-control" id="Peso" name="peso" placeholder="Peso" value="<?php echo isset($_POST['peso']) ? $_POST['peso'] : '' ?>">
		    <?php echo empty($_POST['peso']) && isset($_POST['submit']) ? '<div class="alert alert-danger" role="alert">Campo peso requerido</div>' : ''; 
		     ?>
		  </div>
	</div>
	<div class="col-12 col-md-6 col-lg-6">
		  <div class="form-group">
		    <label for="Categoria">*Categoria</label>
		    <input type="text" class="form-control" id="Categoria" name="categoria" placeholder="Categoria" value="<?php echo isset($_POST['categoria']) ? $_POST['categoria'] : '' ?>">
		    <?php echo empty($_POST['categoria']) && isset($_POST['submit']) ? '<div class="alert alert-danger" role="alert">Campo categoria requerido</div>' : ''; 
		     ?>
		  </div>
	</div>
	<div class="col-12 col-md-6 col-lg-6">
		  <div class="form-group">
		    <label for="Stock">*Stock</label>
		    <input type="number" class="form-control" id="Stock" name="stock" placeholder="Stock" value="<?php echo isset($_POST['stock']) ? $_POST['stock'] : '' ?>">
		    <?php echo empty($_POST['stock']) && isset($_POST['submit']) ? '<div class="alert alert-danger" role="alert">Campo stock requerido</div>' : ''; 
		     ?>
		  </div>
	</div>
	<div class="col-12 text-center">
		 <button type="submit" class="btn btn-primary" name="submit">Subir producto</button>
	</div>
		  
		 
		</form>

		<?php 

		if (isset($_POST['submit'])) {
			if(!empty($_POST['nombre']) && !empty($_POST['referencia']) && !empty($_POST['precio']) && !empty($_POST['peso']) && !empty($_POST['categoria']) && !empty($_POST['stock']) ){

			   $nombre = $_POST['nombre'];
			   $referencia = $_POST['referencia'];
			   $precio = (int) $_POST['precio'];
			   $peso = (int) $_POST['peso'];
			   $categoria = $_POST['categoria'];
			   $stock = (int) $_POST['stock'];
			   
              $producto->InsertarUsuario($nombre, $referencia, $precio, $peso, $categoria, $stock);

			   if($producto){
                  echo "<script>alert('Producto ". $nombre." cargado a la base de datos con exito');</script>";
			   }else{
			   	echo "error";
			   }

			 }

				
		}

	?>

	</div>
</div>



<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>
</html>