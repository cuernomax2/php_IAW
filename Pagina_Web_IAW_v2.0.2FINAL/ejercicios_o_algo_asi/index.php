<?php
session_start();//Utilizo este sistema para que, se por calqueira motivo o usuario volve ao index.php
session_destroy();//A súa sesión sexa destruida (por precaución).
echo '<!DOCTYPE html>';
echo '<html lang="es">';
echo '<body>';
echo '<h2>Para acceder inicie sesión por favor</h2>';
echo '<!-- Se procesa en login.php y se envía por POST, no por GET-->';
echo '<form action="login.php" method="post">';
echo '<input name="usuario" type="text" placeholder="Escriba o seu nome de usuario">';
echo '<br><br>';
echo '<input name="palabra_secreta" type="password" placeholder="Contrasinal">';
echo '<br><br>';
echo '<!--Lo siguiente envía el formulario-->';
echo '<input type="submit" value="Iniciar sesión">';
echo '</form>';
echo '<h1>¿Todavía non ten conta?</h1>';
echo '<a href="register.html">Rexístrese gratis aquí</a>';
echo '</body>';
echo '</html>';
?> 
