<?php
require_once("../../conexao.php"); 

$nome = $_POST['nome_mec'];
$cpf = $_POST['cpf'];
$telefone = $_POST['telefone_mec'];
$email = $_POST['email_mec'];
$endereco = $_POST['endereco_mec'];

$antigo = $_POST['antigo'];
$antigo2 = $_POST['antigo2'];
$id = $_POST['txtid2'];

if($nome == ""){
    echo 'Name is Required!';  
    exit();
}
if($cpf == ""){
    echo 'CPF is Required!';  
    exit();
}
if($telefone == ""){
    echo 'Phone is Required!';  
    exit();
}
if($email == ""){
    echo 'Email is Required!';  
    exit();
}
if($endereco == ""){
    echo 'Address is Required!';  
    exit();
}

// Verificar se o registro já existe no banco
if($antigo != $cpf){
    $query = $pdo->query("SELECT * FROM mecanico WHERE cpf = '$cpf'");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $total_reg = @count($res);
    if($total_reg > 0){
        echo 'This CPF is already registered!';  
        exit();
    }
}

// Verificar se o registro com mesmo e-mail já existe no banco
if($antigo2 != $email){
    $query = $pdo->query("SELECT * FROM mecanico WHERE email = '$email'");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $total_reg = @count($res);
    if($total_reg > 0){
        echo 'This Email is already registered!';  
        exit();
    }
}

if($id == ""){
    $res = $pdo->prepare("INSERT INTO public.mecanico(nome, cpf, telefone, email, endereco) VALUES 
                        (:nome, :cpf, :telefone, :email, :endereco) ");
    $res2 = $pdo->prepare("INSERT INTO public.usuarios(nome, cpf, email, senha, nivel) VALUES
                        (:nome, :cpf, :email, :senha, :nivel) ");
    $res2->bindValue(":senha", $passDefault);
    $res2->bindValue(":nivel", 'mecanico');
}else{
    $res = $pdo->prepare("UPDATE mecanico SET nome = :nome, cpf = :cpf, email = :email, endereco = :endereco, telefone = :telefone WHERE id = '$id'");

    $res2 = $pdo->prepare("UPDATE usuarios SET nome = :nome, cpf = :cpf, email = :email WHERE cpf = '$antigo'");
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

echo 'Saved successfully!';
?>