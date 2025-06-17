<?php require_once 'lock.php'; // Permite usar variaveis de SESSION do "user" logado

    require_once 'funcoes.php';

    if(formNotSent()){
        header('location:home.php?code=0');
        die;
    }

    if(blankGame()) {
        header('location:home.php?code=2');
        die;
    }

    if (!NumInput()) {//Verifica se o campo n "nota" é numerico
        header('location:home.php?code=7');
        die;
    }    

    $jogo = $_POST['jogo']; // jogo vindo do form (POST)
    $nota = $_POST['nota']; // nota vindo do form
    $id   = $_SESSION['id']; // id vindo sa sessão (SESSION)

    require_once 'conexao.php';

    $conn = conectar_banco();

    $sql = "INSERT INTO tb_jogos (jogo, nota, usuario_id) 
            VALUES (?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        header('location:home.php?code=3');
        die;
    }

    if(!mysqli_stmt_bind_param($stmt, 'sii', $jogo, $nota, $id)) {
        header('location:home.php?code=3');
        die;
    }

    if(!mysqli_stmt_execute($stmt)) {
        header('location:home.php?code=3');
        die;
    }

    header('location:home.php');

?>