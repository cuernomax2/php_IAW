<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=2.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
<p style="color:red;text-align:right;">
<?php
session_start();
echo "Benvido: ".$_SESSION['usuario'];
?>
<h1>Formulario de cambio de datos</h1>
<form method="post" action="modif_perfil_script.php" name="rexistro">
    <div class="form-element">
        <label>Contrasinal</label>
        <input type="password" name="contrasinal_1"/>
    </div>
    <p></p>
    <div class="form-element">
        <label>Repita a contrasinal</label>
        <input type="password" name="contrasinal_2"/>
    </div>
    <p></p>
    <div class="form-element">
        <label>Nome</label>
        <input type="text" name="nome"/>
    </div>
    <p></p>
    <div class="form-element">
        <label>Direccion</label>
        <input type="text" name="direccion"/>
    </div>
    <p></p>
     <div class="form-element">
        <label>Telefono</label>
        <input type="text" name="telefono">
    </div>
    <p></p>
    <div class="form-element">
        <label>DNI</label>
        <input type="text" name="nifdni"/>
    </div>
    <p></p>
    <div class="form-element">
        <label>Email</label>
        <input type="email" name="email"/>
    </div>
    <p></p>
    <button type="submit" name="register" value="register">Submit</button>
</form>
<p>
<a href="logged.php">Volver ao inicio</a>
</p>
</body>
</html> 
