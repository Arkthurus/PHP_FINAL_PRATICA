<?php require_once 'cadeado.php'; // Permite usar variaveis de SESSION do "user" logado

    require_once 'funcoes.php';

    if(form_nao_enviado()){
        header('location:home.php?code=0');
        die;
    }

    if(jogo_em_branco()) {
        header('location:home.php?code=2');
        die;
    }

    if (!campo_eh_num()) {//Verifica se o campo n "nota" é numerico
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