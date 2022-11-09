<?php

if (isset($_POST['consultaT'])):
	include_once("crear.php");
	$producto = new Productos();
    
    $datos = "";
	$id = $_POST['consultaT'];
	$edita = $producto->CargarInfo("WHERE ID = ".$id);




    $datos .=    '<form action="index.php" method="POST">';
            	 foreach($edita as $valor):
      $datos .=   '<div class="form-group">
    		    <label for="Nombre">*Nombre</label>
    		    <input type="text" class="form-control" id="Nombre" name="nombre" placeholder="Nombre" value="'.$valor['Nombre_Producto'].'">
    		    
    		  </div>
    		  <div class="form-group">
    		    <label for="Referencia">Referencia</label>
    		    <input type="text" class="form-control" id="Referencia" name="referencia" placeholder="Referencia" value="'. $valor['Referencia'].'" >
    		   
    		  </div>
    		  <div class="form-group">
    		    <label for="Precio">Precio</label>
    		    <input type="number" class="form-control" id="Precio" name="precio" placeholder="Precio" value="'. $valor['Precio'].'" >
    		    
    		  </div>
    		  <div class="form-group">
    		    <label for="Peso">Peso</label>
    		    <input type="number" class="form-control" id="Peso" name="peso" placeholder="Peso" value="'.$valor['Peso'].'">
    		    
    		  </div>
    		  <div class="form-group">
    		    <label for="Categoria">Categoria</label>
    		    <input type="text" class="form-control" id="Categoria" name="categoria" placeholder="Categoria" value="'. $valor['Categoria'].'">
    		    
    		  </div>
    		  <div class="form-group">
    		    <label for="Stock">Stock</label>
    		    <input type="number" class="form-control" id="Stock" name="stock" placeholder="Stock" value="'.$valor['Stock'].'">
    		    
    		  </div>
    		  <input type="hidden" class="form-control" id="Stock" name="ID" placeholder="Stock" value="'.$valor['ID'].'">
    		  <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">cerrar</button>
            <button type="submit" class="btn btn-primary" name="editar">editar</button>
          </div>
            </form>';
     endforeach; 

echo $datos;

endif;

?>

