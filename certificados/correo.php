<?php

if (isset($_POST['enviar'])){
    if (!empty($_POST['name']) && !empty($_POST['grade']) && !empty($_POST['email']))
    {
        $name= $_POST['name'];
        $grade=$_POST['grade'];
        $email=$_POST['email'];
        $header= "from: marianaochoaquiceno@hotmail.com" . "\r\n";
        $header.= "reply-to: savafxd78@gmail.com" . "\r\n";
        $header.="X-Mailer : PHP/".phpversion();
    }
}

?>