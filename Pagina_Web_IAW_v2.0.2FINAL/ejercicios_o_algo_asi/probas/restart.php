<?php	
	$mysqli_link = mysqli_connect("localhost","root","","frota");
	#Crea la conexion
	mysqli_set_charset($mysqli_link, "utf8");

	/*

	Este archivo está creado para servir de base para poder hacer pruebas en la base de datos
	mientras aún se está desarrollando la página web.
	Está pensado para poder tener la libertar de hacer muchos inserts en la base de datos
	y poder hacer un restart del mismo de manera sencilla y rápida

	*/


	if (mysqli_connect_errno()) {
		printf("Conexion con MySQL fallida, error: %s",mysqli_connect_error());
		exit;
	}#Comprueba si ha habido error y si la hay termina el programa

	$tables = array (
	"CREATE TABLE usuario (usuario varchar (24), contrasinal varchar (8), nome varchar (60), direccion varchar (90), telefono int, nifdni varchar (9), email varchar (30),tipo_usuario char(1));",
	"CREATE TABLE novo_rexistro (usuario varchar (24), contrasinal varchar (8), nome varchar (60), direccion varchar (90), telefono int, nifdni varchar (9), email varchar (30));",
	"CREATE TABLE vehiculo_aluguer (modelo varchar (80), cantidade int, descricion varchar (120), marca varchar (24), prezo int, foto varchar (1000));",
	"CREATE TABLE vehiculo_alugado (usuario varchar(24), modelo varchar (80), cantidade int, descricion varchar (120), marca varchar (24), foto varchar (1000));",
	"CREATE TABLE vehiculo_devolto (usuario varchar (24), modelo varchar (80), cantidade int, descricion varchar (120), marca varchar (24), foto varchar (1000));",
	"CREATE TABLE vehiculo_venda (modelo varchar (80), cantidade int, descricion varchar (120), marca varchar (24), prezo int, foto varchar (1000));",
	); # Creación del array que guarda la estructura de las tablas de la base de datos "frota"

	$drops = array (
	"DROP TABLE IF EXISTS usuario;",
	"DROP TABLE IF EXISTS novo_rexistro;",
	"DROP TABLE IF EXISTS vehiculo_aluguer;",
	"DROP TABLE IF EXISTS vehiculo_alugado;",
	"DROP TABLE IF EXISTS vehiculo_devolto;",
	"DROP TABLE IF EXISTS vehiculo_venda;",
	); # Creación del array que guarda la estructira de los DROP_TABLE necesarios para un restart de la base de datos

	foreach ($drops as $a) {
		if (mysqli_query($mysqli_link,$a)) {
			echo $a;
			echo "<br/>Eliminación de tabla exitosa<br/>";
		} 
	}
	echo "<br/>";
	foreach ($tables as $b) {
		if (mysqli_query($mysqli_link,$b)) {
			echo $b;
			echo "<br/>Creación de tabla exitosa<br/>";
		} 
	}
	# Ejecución de los arrays con los comandos MySQL


	# XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX


	# - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -# 
	echo "<br/>";
	$insert = "INSERT INTO usuario (usuario, contrasinal, nome, direccion, telefono, nifdni, email, tipo_usuario) VALUES ('manolo','123','Santiago Romero','Avenida Madrid, 69',881468192,'77184239M','sromerodiaz@danielcastelao.org','U');";

	if (mysqli_query($mysqli_link,$insert)) {
		echo "<br/>Inserción de prueba exitosa<br/>";
	} 

	$insert = "INSERT INTO novo_rexistro (usuario, contrasinal, nome, direccion, telefono, nifdni, email) VALUES ('alberto','123','Alberto Alberto','Avenida Alberto, Portal Alberto',488438092,'77184239M','alberto@alberto.org');";

	if (mysqli_query($mysqli_link,$insert)) {
		echo "<br/>Inserción de prueba exitosa<br/>";
	} 
	$insert = "INSERT INTO novo_rexistro (usuario, contrasinal, nome, direccion, telefono, nifdni, email) VALUES ('pedro','123','pedro pino','Avenida Pedro pino, Portal Alberto',488438092,'77141139M','pedro@alberto.org');";

	if (mysqli_query($mysqli_link,$insert)) {
		echo "<br/>Inserción de prueba exitosa<br/>";
	} 

	$insert = "INSERT INTO usuario (usuario, contrasinal, tipo_usuario) VALUES ('admin','admin','A');";
	if (mysqli_query($mysqli_link,$insert)) {
		echo "<br/>Inserción de prueba exitosa<br/>";
	}
	/*
	Estos insert servirán como pruebas provisionales para probar el inicio de sesion con un usuario estandar y otro usuario administrador
	*/

	# - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -#
	$insert = "INSERT INTO vehiculo_aluguer (modelo, cantidade, descricion, marca, prezo, foto) VALUES ('X6969',3,'Coche elegante para gente elegante','peugeot',6969,'imagenes/peugotelegante.jpeg');";
	if (mysqli_query($mysqli_link,$insert)) {
		echo "<br/>Inserción de prueba exitosa<br/>";
	}

	$insert = "INSERT INTO vehiculo_aluguer (modelo, cantidade, descricion, marca, prezo, foto) VALUES ('Q1900',1,'Coche punzante para gente punzante','citroen',69000,'imagenes/citroencactus.jpeg');";
	if (mysqli_query($mysqli_link,$insert)) {
		echo "<br/>Inserción de prueba exitosa<br/>";
	}
	/*
	Este insert sirve para probar la lista de coches en alquiler
	*/ 
	# - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -#

	# - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -#
	$insert = "INSERT INTO vehiculo_venda (modelo, cantidade, descricion, marca, prezo, foto) VALUES ('P4451',2,'Carromato potente para gente potente','mercedes',10999,'imagenes/mercedespotente.jpeg');";
	if (mysqli_query($mysqli_link,$insert)) {
		echo "<br/>Inserción de prueba exitosa<br/>";
	}
	/*
	Este insert sirve para probar la lista de coches a la venta
	*/ 
	# - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -#

	#Crea la conexion
	mysqli_set_charset($mysqli_link, "utf8");

	if (mysqli_connect_errno()) {
		printf("Conexion con MySQL fallida, error: %s",mysqli_connect_error());
		exit;
	}#Comprueba si ha habido error y si la hay termina el programa

	mysqli_close($mysqli_link);
	# Termina la conexión
?>
