<?php
// iniciamos as variables do programa
session_start();
$usuario = $_SESSION['usuario'];
$contrasinal_1 = $_REQUEST['contrasinal_1'];
$contrasinal_2 = $_REQUEST['contrasinal_2'];
$nome = $_REQUEST['nome'];
$direccion = $_REQUEST['direccion'];
$telefono = $_REQUEST['telefono'];
$nifdni = $_REQUEST['nifdni'];
$email = $_REQUEST['email'];
$erros = array();//Array que recollerá todos os erros no rexistro
$contador = 0;//Variable contador que servirá tamén para comprobar se facer a inserción ou non

//Conectarse á base de datos
$db = mysqli_connect("localhost", "root", "", "frota");

//Rexistro dun novo usuario
  //Mecanismo de validación do formulario de rexistro. Asegurámonos de que todos os datos están enchidos
if (strlen($usuario) > 24){ 
  $erros[$contador] = "O usuario é demasiado longo (24 caracteres máximo)"; 
  $contador++;
}
  
if (strlen($contrasinal_1) > 8){ 
  $erros[$contador] = "A contrasinal_1 é demasiado longa (8 caracteres máximo)"; 
  $contador++;
}

if (strlen($contrasinal_2) > 8){ 
  $erros[$contador] = "A contrasinal_2 é demasiado longa (8 caracteres máximo)"; 
  $contador++;
}
  
if (strlen($nome) > 60){ 
  $erros[$contador] = "O nome é demasiado longo (24 caracteres máximo)"; 
  $contador++;
} 
  
if (strlen($direccion) > 60){ 
  $erros[$contador] = "A direccion é demasiado longa (90 caracteres máximo)"; 
  $contador++;
}
  
if (strlen($telefono) > 10){ 
  $erros[$contador] = "O teléfono é demasiado longo (10 caracteres máximo)"; 
  $contador++;
}
  
if (strlen($nifdni) > 9){ 
  $erros[$contador] = "O DNI é demasiado longo (9 caracteres máximo)"; 
  $contador++;
}
  
if (strlen($email) > 30){ 
  $erros[$contador] = "O e-mail é demasiado longo (30 caracteres máximo)"; 
  $contador++;
}

if ($contrasinal_1 != $contrasinal_2){
  $erros[$contador] = "As contrasinais non coinciden";
  $contador++;
  }
  
if($contador != 0){//Creamos un if/else que comprobe se a variable $contador está a 0 ou non
//En caso de que contador != 0 significa que houbo erros no cambio de datos e cun foreach procedemos
//a mostralos todos por pantalla
  foreach ($erros as $valor){
    echo $valor."";
    echo "<br>";
  }
    
  ?>
  <p><a href="modif_perfil.html">Volver ao formulario de cambio de datos</a></p>
  <p><a href="logged.php">Volver ao menú principal</a></p>
  <?php
}

else{
  if ($contrasinal_1 != ""){
    $query = "UPDATE usuario SET contrasinal='$contrasinal_1' WHERE `usuario`='$usuario'";
    mysqli_query($db, $query);
  }

  if($nome != ""){
    $query = "UPDATE usuario SET nome='$nome' WHERE `usuario`='$usuario'";
    mysqli_query($db, $query);
  }

  if($direccion != ""){
    $query = "UPDATE usuario SET direccion='$direccion' WHERE `usuario`='$usuario'";
    mysqli_query($db, $query);
  }

  if($telefono != ""){
    $query = "UPDATE usuario SET telefono='$telefono' WHERE `usuario`='$usuario'";
    mysqli_query($db, $query);
  }

  if($nifdni != ""){
    $query = "UPDATE usuario SET nifdni='$nifdni' WHERE `usuario`='$usuario'";
    mysqli_query($db, $query);
  }

  if($email != ""){
    $query = "UPDATE usuario SET email='$email' WHERE `usuario`='$usuario'";
    mysqli_query($db, $query);
  }

  //Se non se atopan erros no formulario mandámolo á base de datos novo_rexistro
echo "Cambios completados, serás redirixido ao menú en 3 segundos...";
mysqli_close($db);
header("refresh:3; url=logged.php");
}

//header("refresh:5; url=register.html" );

//echo 'A páxina refrescarase en 5 segundos. Se queres ir ao index fai click <a href="index.html">aquí</a>.';
?> 
