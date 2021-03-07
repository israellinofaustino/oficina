<?php
require_once("../conexao.php"); 

$nome = $_POST['nome_usu'];
$cpf = $_POST['cpf_usu'];
$email = $_POST['email_usu'];
$senha = $_POST['senha_usu'];

$antigo = $_POST['antigo_usu'];
$id = $_POST['id_usu'];

if($nome == ""){
    echo 'O nome é obrigatório!';  
    exit();
}
if($cpf == ""){
    echo 'O CPF é obrigatório!';  
    exit();
}
if($email == ""){
    echo 'O e-mail é obrigatório!';  
    exit();
}
if($senha == ""){
    echo 'A senha é obrigatória!';  
    exit();
}

// Verificar se o registro já existe no banco
if($antigo != $cpf){
    $query = $pdo->query("SELECT * FROM oficina.usuarios WHERE cpf = '$cpf'");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $total_reg = @count($res);
    if($total_reg > 0){
        echo 'Esse CPF já esta cadastrado!';  
        exit();
    }
}

$res2 = $pdo->prepare("UPDATE oficina.usuarios SET nome = :nome, cpf = :cpf, email = :email, senha = :senha WHERE id = '$id'");   


$res2->bindValue(":nome", $nome);
$res2->bindValue(":cpf", $cpf);
$res2->bindValue(":email", $email);
$res2->bindValue(":senha", $senha);
$res2->execute();

echo 'Salvo com Sucesso!';


?>