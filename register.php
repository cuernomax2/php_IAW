<?php
// iniciamos as variables do programa
$usuario = $_REQUEST['usuario'];
$contrasinal = $_REQUEST['contrasinal'];
$nome = $_REQUEST['nome'];
$direccion = $_REQUEST['direccion'];
$telefono = $_REQUEST['telefono'];
$nifdni = $_REQUEST['nifdni'];
$email = $_REQUEST['email'];
$erros = array();
$contador = 0;

// conectarse á base de datos
$db = mysqli_connect("localhost", "root", "", "frota");

// rexistro dun novo usuario
  // mecanismo de validación do formulario de rexistro. Asegurámonos de que todos os datos están enchidos
if (strlen($usuario) < 1 || strlen($usuario) > 24){ 
  $erros[$contador] = "O usuario é inexistente ou demasiado longo (24 caracteres máximo)"; 
  $contador++;
}
  
if (strlen($contrasinal) < 1 || strlen($contrasinal) > 8){ 
  $erros[$contador] = "A contrasinal é inexistente ou demasiado longa (8 caracteres máximo)"; 
  $contador++;
}
  
if (strlen($nome) < 1 || strlen($nome) > 60){ 
  $erros[$contador] = "O nome é inexistente ou demasiado longo (24 caracteres máximo)"; 
  $contador++;
} 
  
if (strlen($direccion) < 1 || strlen($direccion) > 60){ 
  $erros[$contador] = "A direccion é inexistente ou demasiado longa (90 caracteres máximo)"; 
  $contador++;
}
  
if (strlen($telefono) < 1 || strlen($telefono) > 10){ 
  $erros[$contador] = "O teléfono é inexistente ou demasiado longo (10 caracteres máximo)"; 
  $contador++;
}
  
if (strlen($nifdni) < 1 || strlen($nifdni) > 9){ 
  $erros[$contador] = "O DNI é inexistente ou demasiado longo (9 caracteres máximo)"; 
  $contador++;
}
  
if (strlen($email) < 1 || strlen($email) > 30){ 
  $erros[$contador] = "O e-mail é inexistente ou demasiado longo (30 caracteres máximo)"; 
  $contador++;
}
  // primeiro debemos comprobar a base de datos para saber 
  // se existe ou non un usuario repetido
$user_check_query = "SELECT usuario FROM `novo_rexistro` WHERE usuario='$usuario'";
$resultado = mysqli_query($db, $user_check_query);
$filas = mysqli_num_rows($resultado);
  //gárdase o resultado da query en $resultado e compróbase
  //o número de filas. Se este é maior que 0 salta erro
if (($filas) > 0){

  $erros[$contador] = "Erro usuario repetido";
  $contador++;
}

if($contador != 0){

  foreach ($erros as $valor){
    echo $valor."";
    echo "<br>";
  }
    
  ?>
  <p><a href="register.html">Volver ao formulario de rexistro</a></p>
  <p><a href="index.html">Volver ao inicio</a></p>
  <?php
}

else{
  // Se non se atopan erros no formulario mandámolo á base de datos novo_rexistro
  echo "Rexistro completado, serás redirixido ao index en 3 segundos...";
  $query = "INSERT INTO novo_rexistro (usuario, contrasinal, nome, direccion, telefono, nifdni, email) VALUES ('$usuario', '$contrasinal', '$nome', '$direccion', '$telefono', '$nifdni', '$email')";
  mysqli_query($db, $query);
  mysqli_close($db);
  header("refresh:3; url=index.html");
}

//header("refresh:5; url=register.html" );

//echo 'A páxina refrescarase en 5 segundos. Se queres ir ao index fai click <a href="index.html">aquí</a>.';
?>
