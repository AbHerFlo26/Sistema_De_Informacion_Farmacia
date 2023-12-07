<?php
session_start();
if (empty($_SESSION["id"])) {
    header("Location: Login.php");
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Farmacia de Jesus Medico</title>
    <link rel="preload" href="normalize.css" as="style"> <!-- Carga mas rapido los estilos -->
    <link rel="stylesheet" href="normalize.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <link rel="preload" href="estilos.css" as="style"> <!-- Carga mas rapido los estilos -->
    <link href="estilos.css" rel="stylesheet">
</head>

<body>
    <header>
    <h1 class ="titulo">Farmacia de Jesus Medico <span>Bienvenido</span></h1>
        <?php
        echo "USUARIO: ".$_SESSION["nombre"]." ".$_SESSION["Apellidos"];
        ?>
    </header>
    <main>
        <h2>Menu de Formularios</h2>
        <ul>
            <li><a href="Cliente.html">Cliente</a></li>
            <li><a href="Empleado.html">Empleado </a></li>
            <li><a href="Venta.html">Venta</a></li>
	    <li><a href="ProductoG.html">Producto General</a></li>
	    <li><a href="Medicamento.html">Medicamento</a></li>
 	    <li><a href="Compuesto.html">Compuestos</a></li>
 	    <li><a href="Pedido.html">Pedidos</a></li>
 	    <li><a href="Proveedor.html">Proveedor</a></li> 
        <li><a href="controlador_cerrar_session.php"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-logout-2" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
  <path d="M10 8v-2a2 2 0 0 1 2 -2h7a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-2" />
  <path d="M15 12h-12l3 -3" />
  <path d="M6 15l-3 -3" />
</svg></a></li> 

        </ul>
    </main>
    <footer>
        <p>&copy; 2023 DERECHOS RESERVADOS A DERECHOS DE AUTOR</p>
    </footer>
</body>
</html>