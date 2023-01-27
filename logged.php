 <?php
session_start();
if (empty($_SESSION["usuario"])) {
    header("Location: index.html");
    exit();
}
echo "Soy un mensaje secreto";
?>
<!-- También se puede usar HTML como en todos los scripts de PHP -->
<p>
    Hola mundo, soy un párrafo HTML que solamente pueden ver los usuarios logueados
</p>
<p>
<a href="logout.php">Cerrar sesión</a>
</p>
