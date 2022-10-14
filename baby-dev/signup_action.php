<?php

require 'config.php';
require 'models/Auth.php';


// VALIDACAO DO CADASTRO
$name = filter_input(INPUT_POST, 'name');
$birthdate = filter_input(INPUT_POST, 'birthdate');
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$password = filter_INPUT(INPUT_POST, 'password');

if($email && $password && $birthdate &&  $name ){

    $auth = new Auth($pdo, $base);

    //VERIFICA SE A DATA E VALIDA
    $birthdate = explode('/', $birthdate);
    if(count($birthdate) != 3){
        $_SESSION['flash'] = 'data de nascimento invalida';
        header("Location:".$base."/signup.php);
        exit;
    }

    $birthdate = $birthdate[2].'-'.$birthdate[1].'-'.$birthdate[0];
    if(strtotime($birthdate) === false) {
        $_SESSION['flash'] = 'Data de nascimento invalida';
        header("Location: ".$base."/signup.php");
        exit;

    }
    

    if() {
    }

    


}

$_SESSION['flash'] = 'Todos os Campos sao Obrigatorios.';
header("Location:".$base."/signup.php");
exit;