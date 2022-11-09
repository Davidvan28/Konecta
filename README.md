# Konecta
Prueba tecnica desarrollador PHP
Para la instalación del programa se tendrá que descargar las carpetas o clonar el repositorio en su escritorio. 
Deberá tener un servidor local como por ejemplo XAMPP para poder correr el sistema.
Asegúrese de guardar el repositorio dentro del disco local C en la carpta xampp/httdocs
Cree una base de datos en MySql llamada Konecta.
En la carpeta descargada encontrará el archivo Konecta.sql el cual deberá importar a la base de datos que acabo de crear. 
Una vez cargado el archivo Konecta.sql a la base de datos podrá configurar el archivo db.php el cual se encuentra en la carpeta includes del repositorio descargado. Modifique los datos que considere pertinentes para el funcionamiento del sistema.
Ahora podrá ingresar al navegador y en la url debe poner localhost más la ruta de la carpeta por ejemplo localhost/konecta/
Ahora podrá navegar por las opciones del sistema; en el inicio encontrara la lista de productos agregados a la base de datos los cuales podrá modificar o eliminar, también podrá agregar un producto nuevo a la base de datos, gestionar una venta o ver el listado de ventas.


CONSULTAS MYSQL 
1.Realizar una consulta que permita conocer cuál es el producto que más stock tiene.
select MAX(Stock), Nombre_Producto ,ID from productos

2.Realizar una consulta que permita conocer cuál es el producto más vendido.
select MAX(Cantidad_venta), Nombre_Producto ,id_ventas from ventas INNER JOIN productos ON productos.ID = ventas.fk_producto WHERE 1

