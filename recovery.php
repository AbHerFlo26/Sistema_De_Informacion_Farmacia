<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

require_once('conexion_bd.php');
$correo = $_POST['Correo'];
$query = "SELECT * FROM usuario WHERE correo = '$correo' AND status = 1";
$result = $conexion->query($query);
$row = $result->fetch_assoc();

if ($result->num_rows >0){
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp-mail.outlook.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'SistemaFarmacia_502@outlook.com';                     //SMTP username
        $mail->Password   = 'Farmacia2023';                               //SMTP password
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('SistemaFarmacia_502@outlook.com', 'Farmacia');
        $mail->addAddress('theproxy529@gmail.com', 'Hugo');     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Recuperacion de clave';
        $mail->Body    = 'Hola, este es un correo generado para solicitar tu recuperación de contraseña, 
        por favor, visita la página de <a href="localhost/BD_Farmacia/change_password.php?id='.$row['id'].'">Recuperación de contraseña</a>';

    
        $mail->send();
        header("location: Login.php?message=ok");

    } catch (Exception $e) {
        header("location: Login.php?message=error");
    }
    

}else{
    header("location: Login.php?message=not_found");
}

?>