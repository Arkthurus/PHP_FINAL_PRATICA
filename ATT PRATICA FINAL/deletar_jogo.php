<?php require_once 'lock.php';

    if (!isset($_GET['id_jogo'])) {
        header('location:home.php?code=0');
        die;
    }

    $id_jogo = (int)$_GET['id_jogo']; // id do jogo vindo via GET
    require_once 'conexao.php';

    $conn = conectar_banco();

    $id_usuario = $_SESSION['id']; // id do usuário logado (SESSION)


    $sql = "DELETE FROM tb_jogos WHERE id_jogo = $id_jogo AND
            usuario_id = $id_usuario";

    mysqli_query($conn, $sql);

    $linhas = mysqli_affected_rows($conn);

    if ($linhas <= 0) {
        header('location:home.php?code=3');
        die;
    }

    header('location:home.php');   

?>