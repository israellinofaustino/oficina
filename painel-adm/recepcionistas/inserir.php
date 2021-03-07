<?php
require_once("../../conexao.php"); 

$nome = $_POST['nome_recep'];
$cpf = $_POST['cpf'];
$telefone = $_POST['telefone_recep'];
$email = $_POST['email_recep'];
$endereco = $_POST['endereco_recep'];

$antigo = $_POST['antigo'];
$antigo2 = $_POST['antigo2'];
$id = $_POST['txtid2'];

if($nome == ""){
    echo 'O nome é obrigatório!';  
    exit();
}
if($cpf == ""){
    echo 'O CPF é obrigatório!';  
    exit();
}
if($telefone == ""){
    echo 'O telefone é obrigatório!';  
    exit();
}
if($email == ""){
    echo 'O e-mail é obrigatório!';  
    exit();
}
if($endereco == ""){
    echo 'O endereço é obrigatório!';  
    exit();
}

// Verificar se o registro já existe no banco
if($antigo != $cpf){
    $query = $pdo->query("SELECT * FROM oficina.recepcionistas WHERE cpf = '$cpf'");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $total_reg = @count($res);
    if($total_reg > 0){
        echo 'Esse CPF já esta cadastrado!';  
        exit();
    }
}

// Verificar se o registro com mesmo e-mail já existe no banco
if($antigo2 != $email){
    $query = $pdo->query("SELECT * FROM oficina.recepcionistas WHERE email = '$email'");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $total_reg = @count($res);
    if($total_reg > 0){
        echo 'Esse E-MAIL já esta cadastrado!';  
        exit();
    }
}

if($id == ""){
    $res = $pdo->prepare("INSERT INTO oficina.recepcionistas SET nome = :nome, cpf = :cpf, email = :email, endereco = :endereco, telefone = :telefone");   

    $res2 = $pdo->prepare("INSERT INTO oficina.usuarios SET nome = :nome, cpf = :cpf, email = :email, senha = :senha, nivel = :nivel");
    $res2->bindValue(":senha", '123');
    $res2->bindValue(":nivel", 'recepcionistas');
}else{
    $res = $pdo->prepare("UPDATE oficina.recepcionistas SET nome = :nome, cpf = :cpf, email = :email, endereco = :endereco, telefone = :telefone WHERE id = '$id'");

    $res2 = $pdo->prepare("UPDATE oficina.usuarios SET nome = :nome, cpf = :cpf, email = :email WHERE cpf = '$antigo'");   
}

$res->bindValue(":nome", $nome);
$res->bindValue(":cpf", $cpf);
$res->bindValue(":telefone", $telefone);
$res->bindValue(":email", $email);
$res->bindValue(":endereco", $endereco);

$res2->bindValue(":nome", $nome);
$res2->bindValue(":cpf", $cpf);
$res2->bindValue(":email", $email);

$res->execute();
$res2->execute();

echo 'Salvo com Sucesso!';
?>