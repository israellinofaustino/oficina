<?php
require_once("conexao.php");
@session_start();
$email = $_POST['email'];
$senha = $_POST['senha'];

$query = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email AND senha = :senha");
$query->bindValue(":email", $email);
$query->bindValue(":senha", $senha);
$query->execute();
$res = $query->fetchAll(PDO::FETCH_ASSOC);

$total_reg = @count($res);
    if($total_reg > 0){

        $_SESSION['id_usuario'] = $res[0]['id']; 
        $_SESSION['nome_usuario'] = $res[0]['nome']; 
        $_SESSION['cpf_usuario'] = $res[0]['cpf']; 
        $_SESSION['nivel_usuario'] = $res[0]['nivel']; 

        $nivel = $res[0]['nivel'];

        if($nivel == 'admin'){
            echo "<script language='javascript'> window.location='painel-adm' </script>";
        }
        if($nivel == 'mecanico'){
            echo "<script language='javascript'> window.location='painel-mecanico' </script>";
        }
        if($nivel == 'recep'){
            echo "<script language='javascript'> window.location='painel-recepcao' </script>";
        }

    }else{
        echo "<script language='javascript'> window.alert('Usuários ou Senha Incorreta!') </script>";
        echo "<script language='javascript'> window.location='index.php' </script>";
    }
?>