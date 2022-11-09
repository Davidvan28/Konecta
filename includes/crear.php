<?php

//incluimos la base de datos
include_once("db.php");

//se crea una clase productos 
 Class Productos extends DB{

  //declarar las variables correspondientes a la table de la base de datos
 	private $ID;
 	private $nombre;
 	private $referencia;
 	private $precio;
 	private $peso;
 	private $categoria;
 	private $stock;
 	private $fecha;

 //declara constructor para conectar con la base de datos
 	public function _construct(){
 		$this->conexion = new DB();
 		//$this->conexion = $this->conexion->connect();
 	}
// funcion que ayudara a insertar datos a la table en mysql
 	public function InsertarUsuario(string $nombre, string $referencia, int $precio, int $peso, string $categoria, int $stock){
         
         $this->$nombre = $nombre;
         $this->$referencia = $referencia;
         $this->$precio = $precio;
         $this->$peso = $peso;
         $this->$categoria = $categoria;
         $this->$stock = $stock;
         $fecha = date('Y-m-d');

         $datosI = $this->connect()->prepare("INSERT INTO `productos`( `Nombre_Producto`, `Referencia`, `Precio`, `Peso`, `Categoria`, `Stock`, `Fecha_Creacion`) VALUES (?,?,?,?,?,?,?)");
         $arrayI = array($this->$nombre,$this->$referencia, $this->$precio, $this->$peso, $this->$categoria, $this->$stock, $fecha );
         $datosI->execute($arrayI);
         return $datosI;
         $datosI->closeCursor(); 
	     $datosI = null; 
 	}

 	public function EliminarDatos(string $ID){
      $eliminar = $this->connect()->prepare("DELETE FROM `productos` WHERE ID = :id");
      $eliminar->bindParam(":id", $ID);
      $eliminar->execute();
      return $eliminar;
      $eliminar->closeCursor(); 
	  $eliminar = null; 
 	}

 	public function CargarInfo(string $codigo){
 		$conectar = $this->connect()->prepare("SELECT `ID`, `Nombre_Producto`, `Referencia`, `Precio`, `Peso`, `Categoria`, `Stock`, `Fecha_Creacion` FROM `productos`".$codigo."");
        $conectar->execute();

        return $conectar;

	 $conectar->closeCursor(); 
	 $conectar = null; 
 	}

 	public function EditarDatos(string $nombre, string $referencia, int $precio, int $peso, string $categoria, int $stock, int $ID){
         $this->$ID = $ID;
 		 $this->$nombre = $nombre;
         $this->$referencia = $referencia;
         $this->$precio = $precio;
         $this->$peso = $peso;
         $this->$categoria = $categoria;
         $this->$stock = $stock;
       $Editar = $this->connect()->prepare("UPDATE `productos` SET `Nombre_Producto`= ?,`Referencia`= ?,`Precio`= ?,`Peso`= ?,`Categoria`= ?,`Stock`= ? WHERE ID = ?");
       $arrayE = array($this->$nombre,$this->$referencia, $this->$precio, $this->$peso, $this->$categoria, $this->$stock, $ID );
       // $Editar->bindParam(":nombre", $nombre);
       // $Editar->bindParam(":referencia", $referencia);
       // $Editar->bindParam(":precio", $precio);
       // $Editar->bindParam(":peso", $peso);
       // $Editar->bindParam(":categoria", $categoria);
       // $Editar->bindParam(":stock", $stock);
       // $Editar->bindParam(":id", $ID);
       $Editar->execute($arrayE);
       return $Editar;
       $Editar->closeCursor(); 
	   $Editar = null; 
	 
 	}
 } 










?>