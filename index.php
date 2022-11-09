<?php 

//incluimos la clase productos
include_once("includes/crear.php");
$producto = new Productos(); //instanciamos la clase productos


//se realiza una consulta en la base de datos 
$conectar = $producto->CargarInfo(" WHERE 1");


//Se evalua si existe eliminar
if (isset($_POST['eliminar'])) {
  //si existe eliminar se procede a eliminar la fila correspondiente al id seleccionado
	$eliminar = $_POST['eliminar'];
	$producto->EliminarDatos($eliminar);
	if ($producto) {
		echo "<script>alert('Datos eliminados'); location.href='index.php';</script>";
	}else{
		echo "<script>alert('Error');</script>";

	};
	

};
//se evalua si existe editar para modificar los valores correspondientes en la table productos
if (isset($_POST['editar'])) {
	$idEditar = (int) $_POST['ID'];
	$nombre = $_POST['nombre'];
	$referencia = $_POST['referencia'];
	$precio = $_POST['precio'];
	$peso = $_POST['peso'];
	$stock = $_POST['stock'];
	$categoria = $_POST['categoria'];

	$producto->EditarDatos($nombre, $referencia, $precio, $peso, $categoria, $stock, $idEditar);

	if ($producto) {
		echo "<script>alert('Producto Editado'); location.href='index.php';</script>";
	};
};

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
	<title>KONECTA</title>
</head>
<body>

<?php include_once("viws/navbar.php"); ?>

<div class="row" style="margin: 0;">
	<div class="col-12 col-sm-12 col-lg-12 text-center justify-center">
		<table class="table table-responsive text-center">
		  <thead>
		    <tr>
		      <th scope="col">ID</th>
		      <th scope="col">NOMBRE</th>
		      <th scope="col">REFERENCIA</th>
		      <th scope="col">PRECIO</th>
		      <th scope="col">PESO</th>
		      <th scope="col">CATEGORIA</th>
		      <th scope="col">STOCK</th>
		      <th scope="col">FECHA CREACIÓN</th>
		      <th scope="col">Eliminar</th>
		      <th scope="col">Editar</th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php foreach ($conectar as  $value):?>
		    <tr>
		      <th scope="row"><?php echo $value['ID']; ?></th>
		      <td scope="row"><?php echo $value['Nombre_Producto']; ?></td>
		      <td scope="row"><?php echo $value['Referencia']; ?></td>
		      <td scope="row"><?php echo number_format($value['Precio']); ?></td>
		      <td scope="row"><?php echo $value['Peso']; ?> Libras</td>
		      <td scope="row"><?php echo $value['Categoria']; ?></td>
		      <td scope="row"><?php echo $value['Stock']; ?></td>
		      <td scope="row"><?php echo $value['Fecha_Creacion']; ?></td>
		      <td scope="row">
		      	<form action="" method="POST">
		      		<input type="hidden" name="eliminar" value="<?php echo $value['ID']; ?>">
		      		<button type="submit" class="btn btn-primary">Eliminar</button>
		      	</form>
		      </td>
		      <td>
		      	<div id="ver">
		      		<input type="hidden" name="editar" value="<?php echo $value['ID']; ?>">
		      		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">Editar</button>
		      	</div>
		      	
		      </td>
		    </tr>
		<?php endforeach;
		 $conectar->closeCursor(); 
		 $conectar = null; 

		 ?>
		    
		  </tbody>
		</table>
	</div>
</div>
 
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Editar producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="imp">
       
      </div>
      
    </div>
  </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
<script type="text/javascript">
//se utiliza una funcion ajax predefinida para poder traer los datos correspondientes al ID incrustado en el boton EDITAR y mostrarlos en una ventana modal
  function  modal(consultaT){
  $.ajax({
    url: 'includes/modal.php',
    type:'POST',
    dataType: 'html',
    data: {consultaT: consultaT},
  })
  .done(function(cards_li_respuesta){
    $("#imp").html(cards_li_respuesta);
  })
  .fail(function(){
          console.log("err");
  });
};

$(document).on('click', '#ver', function(){
    let a = $(this).find('input').val();
    let b = a;
    if( a =! ''){
      modal(b);
    }else{
      modal();
    }

  });
</script>
</body>
</html>