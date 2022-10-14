<?php
require_once 'dao/UserDaoMysql.php';



//Class autenticacaod de usuario
class Auth{
    private $pdo;  //atributos
    private $base;  //atributos

    //Construtor
    public function __construct(PDO $pdo, $base){
        $this->pdo = $pdo;
        $this->base = $base;

    }


    // funcao verifica se existe um token de login
    public function checkToken(){
        if(!empty($_SESSION['token'])){
            $token = $_SESSION['token'];

            $userDao = new UserDaoMysql($this->pdo);
            $user = $userDao->findByToken($token);

            if($user){
                return $user;
            }

        }



        //SE NAO LOCALIZA REDIRECIONA A PAGINA LOGIN
        header("Location: ".$this->base."/login.php");
        exit;

    }


    
    public function validateLogin($email, $password){
        $userDao = new UserDaoMysql($this->pdo);



        $USER = $userDao->findByEmail($email);
        if($user){

            if(password_verify($password, $user->password)){
                $token = md5(time().rand(0, 9999));

                $_SESSION['token'] = $token;
                $user->token = $token;
                $userDao->update($user);

                return true;
            }
            
        }

        return false;

    }

}