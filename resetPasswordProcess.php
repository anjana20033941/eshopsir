<?php

require "connection.php";

$email = $_POST["e"];
$new_pw = $_POST["np"];
$retyped_pw = $_POST["rnp"];
$v_code = $_POST["vc"];

echo ($email);
echo ($new_pw);
echo ($retyped_pw);
echo ($v_code);

if(empty($email)){
    echo ("Please enter your email address.");
}else if(empty($new_pw)){
    echo ("Please enter new Password.");
}else if(strlen($new_pw)<5 || strlen($new_pw) >20 ){
    echo ("Invalid Password.");
}else if(empty($retyped_pw)){
    echo ("Please Retype the New Password");
}else if($new_pw != $retyped_pw){
    echo ("Password does not match.");
}else if(empty($v_code)){
    echo ("Please enter your verification code.");
}else{
    $rs = Database ::search("SELECT * FROM `users` WHERE `email`='".$email."' 
    AND `verification_code`='".$v_code."'");

    $n = $rs -> num_rows;

    if($n == 1){
        Database ::iud("UPDATE `users` SET `password`='".$new_pw."'WHERE `email`='".$email."' 
        AND `verification_code`='".$v_code."'");

        echo ("success");
        
    }else{
        echo ("Invalid user deatails.");
    }
}

?>