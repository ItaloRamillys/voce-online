<?php
    use PHPMailer\PHPMailer\PHPMailer;

    if (isset($_POST['name']) && isset($_POST['email'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $body = $_POST['body'];
        $phone = $_POST['phone'];

        require_once "vendor/PHPMailer/PHPMailer.php";
        require_once "vendor/PHPMailer/SMTP.php";
        require_once "vendor/PHPMailer/Exception.php";

        $mail = new PHPMailer();
        $mail2 = new PHPMailer();

        //SMTP Settings
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "";
        $mail->Password = '';
        $mail->Port = 465; //587
        $mail->SMTPSecure = "ssl"; //tls

        $mail2->isSMTP();
        $mail2->Host = "smtp.gmail.com";
        $mail2->SMTPAuth = true;
        $mail2->Username = "";
        $mail2->Password = '';
        $mail2->Port = 465; //587
        $mail2->SMTPSecure = "ssl"; //tls

        //Email Response Settings
        $mail2->isHTML(true);
        $mail2->setFrom($mail->Username, "Advogado Jefferson Rodrigues");
        $mail2->addAddress($email);
        $mail2->Subject = "Advogado Jefferson Rodrigues";
        $mail2->Body = "Obrigado pelo seu contato. Em breve entrarei em contato com você e sua conversaremos sobre sua causa. <br>Abraços, Advogado Jefferson Rodrigues";

        //Email Settings
        $mail->isHTML(true);
        $mail->setFrom($email, $name);
        $mail->addAddress($mail->Username);
        $mail->Subject = $subject;
        $mail->Body = $body . "<br> - Telefone para contato: " . $phone;

        if ($mail->send() and $mail2->send()) {
            $status = "success";
            $response = "Email is sent!";
        } else {
            $status = "failed";
            $response = "Something is wrong: <br><br>" . $mail->ErrorInfo;
        }

        exit(json_encode(array("status" => $status, "response" => $response)));
    }
?>
