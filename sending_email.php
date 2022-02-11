<?php
    require_once("vendor/autoload.php");

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    $mail = new PHPMailer();

    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->Host = "smtp.gmail.com";
    $mail->Port = "465";
    $mail->SMTPSecure = "ssl";

    $mail->Username = "barikbuddyi@gmail.com";
    $mail->Password = "DevAbdulBarik@";

    $mail->setFrom("barikbuddyi@gmail.com");
    $mail->addReplyTo("no-reply@barikbuddy.com");

    // recipient
    $mail->addAddress("ealiusazamsha@gmail.com");
    $mail->isHTML();
    $mail->Subject = "Sending from localhost";
    $mail->Body = "
                    <div style='color: blue;font-size: 20px;background-color:grey;'>
                        Thank you buddy!!!
                    </div>
                ";

    if($mail->send()) {
        echo "Email sent";
    } else {
        echo "Sorry somethings wrong";
    }