<?php

require "connection.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if(isset($_GET["e"])){

    $email = $_GET["e"];

    $rs = Database::search("SELECT* FROM `users` WHERE `email`='".$email."'");
    $n = $rs->num_rows;

    if($n == 1){

        $code = uniqid();

        Database::iud("UPDATE `users` SET `verification_code`='".$code."' WHERE `email`='".$email."'");
        
        $mail->IsSMTP();
        $mail = new PHPMailer;
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'kavindaanjuwa1234@gmail.com';
        $mail->Password = 'lvsbandreixtjkfi';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('kavindaanjuwa1234.com', 'Reset Password');
        $mail->addReplyTo('kavindaanjan229@gmail.com', 'Reset Password');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'eShop Forgot Password Verification Code';
        $bodyContent = '<h1 style="color:green;">Your verification code is '.$code.'</h1>';
        $mail->Body    = $bodyContent;

            if(!$mail->send()){
                echo ("Verification Code Sending Failed.");
            }else{
                echo ("success");
            }

    }else{
        echo ("Invalid Email Address.");
    }

}else{
    echo ("Please enter your Email Address First.");
}

?>