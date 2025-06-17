<?php require_once 'funcoes.php';

    // se tentarmos acessar esta página via GET
    if (formNotSent()) {
        // redireciona para a 'index' enviando o codigo de erro 0
        header('location:cadastrarUser.php?code=0');
        die;
    }

    if (empty($_POST["usuarioC"]) || empty($_POST["senhaC"]) || empty($_POST["emailC"])) { // se houver campos em branco no form                    
        header('location:cadastrarUser.php?code=2');// redireciona para a 'index' enviando o codigo de erro 2
        die;
    }
    require_once 'conexao.php';

    $usuarioC = $_POST['usuarioC'];
    $senhaC   = $_POST['senhaC'];
    $emailC   = $_POST['emailC'];

    $conn = conectar_banco();

    // Prepara uma declaração SQL segura para evitar injeção SQL
    // O ? é um placeholder que será substituído pelo valor real
    $stmt = mysqli_prepare($conn, "SELECT * FROM tb_usuarios WHERE email = ?");

    // Associa o parâmetro à declaração preparada
    // "s" indica que é uma string (s = string)
    // $emailC é a variável que contém o email a ser verificado
    if(!mysqli_stmt_bind_param($stmt, 's', $emailC)) {
        header('location:index.php?code=3');
        die;
    }

    // Executa a declaração preparada no banco de dados
    if(!mysqli_stmt_execute($stmt)) {
        header('location:index.php?code=3');
        die;
    }

    // Obtém o resultado da consulta para podermos trabalhar com ele
    $resultado = mysqli_stmt_get_result($stmt);

    // Verifica se a consulta retornou algum registro
    // num_rows conta quantas linhas foram retornadas
    if ($resultado->num_rows > 0) {
        // Se entrou aqui, significa que encontrou pelo menos 1 registro com esse email
        echo "<h1 style='color: red'>Email informado já está cadastrado no Banco</h1>";// Exibe uma mensagem na tela (útil para debug)
        header("location:cadastrarUser.php?code=6");// Redireciona para a página de cadastro com um código de erro (6)
        die;
    }
    
    $query = "INSERT INTO tb_usuarios (usuario, senha, email)
              VALUES (?, ?, ?)";

    $stmtInsert = mysqli_prepare($conn, $query);

    if(!$stmtInsert) {
        header('location:cadastrarUser.php?code=3'); 
        die;
    }

    if(!mysqli_stmt_bind_param($stmtInsert, 'sss', $usuarioC, $senhaC, $emailC)){
        header('location:cadastrarUser.php?code=4');
        die;
    }
    
    if (!mysqli_stmt_execute($stmtInsert)){
        header('location:cadastrarUser.php?code=5');
        die;
    }

    // Armazena a mensagem na sessão
    session_start();
    $_SESSION['mensagem'] = "Usuário cadastrado com sucesso!";
    $_SESSION['tipo_mensagem'] = "sucesso";

    header('location:index.php');
?>