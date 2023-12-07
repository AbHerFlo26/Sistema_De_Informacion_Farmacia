<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
    <link rel="stylesheet" href="estilos_login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <form method="post" action="">
        <?php
        include ("conexion_bd.php");
        include ("controlador.php")
        ?>
        <h1 class="title">Login</h1>
        <label>
            <i class="fa-solid fa-user"></i>
            <input placeholder="Username" type="text" name="username">
        </label>
        <label>
            <i class="fa-solid fa-lock"></i>
            <input placeholder="Password" type="password" name="password">
        </label>
        <a href="usuarios.html" class="link">Registrarse</a>
        <a href="recuperar.php" class="link">¿Olvidaste tu contraseña?</a>
        <button type="submit" name="btningresar" value="INICIAR SESION">Login</button>
        <?php
        if (isset($_GET['message'])){
        
        ?>
        <div class="alert alert-primary" role="alert">

        <?php
        switch ($_GET['message']){
            case 'ok':
                echo 'Por favor, revisa tu correo electronico';
            break;
            case 'succes_password':
                echo 'Inicia sesion con tu nueva contraseña';
            break;

            default:
            echo 'Algo salio mal, intenta de nuevo';
            break;
        }
        ?>
        </div>
        <?php
        }
        ?>
    </form>
    <script src="main.js"></script>
</body>
</html>
