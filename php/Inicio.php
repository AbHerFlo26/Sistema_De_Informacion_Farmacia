<?php
session_start();
if (empty($_SESSION["id"])) {
    header("Location: ../php/Login.php");
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"> <!-- Permite acentos o la letra ñ -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmacia de Jesus Medico</title>
    <link rel="preload" href="../css/normalize.css" as="style"> <!-- Carga mas rapido los estilos -->
    <link rel="stylesheet" href="../css/normalize.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <link rel="preload" href="../css/styles_inicio.css" as="style"> <!-- Carga mas rapido los estilos -->
    <link href="../css/inicio.css" rel="stylesheet">
</head>

<body>
    <header>
        <h1 class ="titulo">Farmacia de Jesus Medico <span>Bienvenido</span></h1>
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
  <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
  <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
</svg>
        <?php
            echo "USUARIO: ".$_SESSION["nombre"]." ".$_SESSION["Apellidos"];
        ?>
    </header>


    <main>
        <h2>Menu de Formularios</h2>
        <ul>
            <li><a href="../html/Cliente.html">Cliente</a></li>
            <li><a href="Login_empleados.php">Empleado </a></li>
            <li><a href="../html/Venta.html">Venta</a></li>
            <li><a href="../html/ProductoG.html">Producto General</a></li>
            <li><a href="../html/Medicamento.html">Medicamento</a></li>
            <li><a href="../html/Compuesto.html">Compuestos</a></li>
            <li><a href="../html/Pedido.html">Pedidos</a></li>
            <li><a href="../html/Proveedor.html">Proveedor</a></li> 
            <li><a href="../php/controlador_cerrar_session.php"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-logout-2" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
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