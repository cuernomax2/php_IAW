<?php
session_start();

if(!isset($_SESSION["usuario"]) ){ //Se a sesión foi pechada en logout.php o usuario será redirixido ao index
	echo "Sesión expirada, serás redirixido ao index en 3 segundos...";
	header("refresh:3; url=index.php");
    	exit();
}

$db = mysqli_connect("localhost","root", "", "frota"); //Conexión coa base de datos.
$usuario = $_SESSION['usuario']; //Gardamos o usuario nunha variable
$modelo = $_REQUEST['modelo']; //Gardamos o código do coche seleccionado nunha variable

$query_select_venda = "SELECT * FROM vehiculo_venda WHERE modelo='$modelo'";
$resultado_venda = mysqli_query($db, $query_select_venda);
$fila_venda = mysqli_fetch_array($resultado_venda, MYSQLI_ASSOC); //Obtemos todos os datos da táboa vehículo_venda nunha variable "$fila" 

if(($cantidade_venda = $fila_venda['cantidade']) > 0){ //Se os coches mercables son > 0 procede
    $query_update_venda = "UPDATE vehiculo_venda SET cantidade=cantidade - 1 WHERE modelo='$modelo'";
    mysqli_query($db, $query_update_venda);

    $query_select_usuario = "SELECT * FROM usuario WHERE usuario='$usuario'";
    $resultado_usuario = mysqli_query($db, $query_select_usuario);
    $fila_usuario = mysqli_fetch_array($resultado_usuario, MYSQLI_ASSOC);
	
    $server_data = date('y-m-d-H-i');
    $recibo_data = date('y-m-d');
    $arquivo = "/opt/lampp/htdocs/ejercicios_o_algo_asi/recibos/"."$usuario"."_$server_data.txt";
    
    $recibo = fopen($arquivo, "w");
    if($recibo == NULL){
    	echo "<br>Ey aquí peto algo";
    }
    
    fprintf($recibo, "Recibo da compra dun %s por parte do usuario %s con data %s\n\n", $modelo, $usuario, $recibo_data);
    
    fprintf($recibo, "Datos do comprador:\nNome: %s\nNIF: %s\nTelefono: %s\nEmail: %s\n\n", $fila_usuario['nome'], $fila_usuario['nifdni'], $fila_usuario['telefono'], $fila_usuario['email']);
    fprintf($recibo, "Datos do vehículo:\nMarca: %s\nModelo: %s\nPrezo: %s\nDescrición: %s\n", $fila_venda['marca'], $fila_venda['modelo'], $fila_venda['prezo'], $fila_venda['descricion']);
    fclose($recibo);
	
    
    echo "Vehículo $modelo mercado correctamente.<br>Redirixindo ao menú principal en 3 segundos...";
    header("refresh:3; url=logged.php");
}

else{ //Se non hai suficientes coches alugables salta erro
	echo "Non foi posible mercar o vehículo (a cantidade dispoñible é de 0).<br>Redirixindo ao menú principal en 3 segundos...";
	header("refresh:3; url=logged.php");
}

mysqli_close($db);
?>
