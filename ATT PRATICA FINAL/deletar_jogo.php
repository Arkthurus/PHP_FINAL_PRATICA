<?php require_once 'cadeado.php';

    if (!isset($_GET['id_jogo'])) {
        header('location:home.php?code=0');
        exit;
    }

    $id_jogo = (int)$_GET['id_jogo']; // id da tarefa vindo via GET
    require_once 'conexao.php';

    $conn = conectar_banco();

    $id_usuario = $_SESSION['id']; // id do usuário logado (SESSION)


    $sql = "DELETE FROM tb_jogos WHERE id_jogo = $id_jogo AND
            usuario_id = $id_usuario";

    mysqli_query($conn, $sql);

    $linhas = mysqli_affected_rows($conn);

    if ($linhas <= 0) {
        header('location:home.php?code=3');
        exit;
    }
    // se não houver intercorrêcias, apenas retornarmos para a home.php
    // sem códigos de erro
    header('location:home.php');   

?>