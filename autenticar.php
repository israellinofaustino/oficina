<?php
require_once("conexao.php");
session_start();

$email = $_POST['email'];
$senha = $_POST['senha'];

$query = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email AND senha = :senha ");
$query->bindValue(":email", $email);
$query->bindValue(":senha", $senha);
$query->execute();
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);


$_SESSION['id_usuario'] = $res[0]['id']; 
$_SESSION['nome_usuario'] = $res[0]['nome']; 
$_SESSION['cpf_usuario'] = $res[0]['cpf']; 
$_SESSION['nivel_usuario'] = $res[0]['nivel'];

if($total_reg > 0){
        if($res[0]['nivel'] == 'admin'){
            header("Location: painel-adm/");
        }

        if($res[0]['nivel'] == 'mecanico'){
            header("Location: painel-mecanico/");
        }

        if($res[0]['nivel'] == 'recepcionistas'){
            header("Location: painel-recep/");
        }
} else {
    echo "<script language='javascript'> window.alert('Incorrect Username or Password!') </script>";
    echo "<script language='javascript'> window.location='index.php' </script>";
}