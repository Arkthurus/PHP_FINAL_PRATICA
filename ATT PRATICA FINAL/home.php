<?php require_once 'cadeado.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ATT PRATICA FINAL - Meus Jogos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>
<body class="container">

    <h1>ATT PRATICA FINAL - Meus Jogos</h1>

    <h2>Bem-vindo, <?= $_SESSION['usuario']; ?>!</h2><br>

    <p>
        <a href="logout.php"><button  class="btn btn-primary btn-sm">Voltar</button></a>
    </p>

    <form action="cadastrar_jogo.php" method="post">

        <p>
            <label for="jogo">Nome do Jogo: </label>
            <input type="text" name="jogo" id="jogo">   
        </p>
        <p>
            <label for="nota">Nota do Jogo: </label>
            <input type="number" name="nota" id="nota" style="margin-left: 10px;">
        </p>
        <button type="submit" class="btn btn-primary btn-sm">Cadastrar</button>
    </form>
    <br>
    <br>

    <?php 

        require_once 'funcoes.php';

        tratar_erros();

        require_once 'conexao.php';

        $conn = conectar_banco();

        $id = $_SESSION['id'];

        // EXIBIR JOGOS DO USUÁRIO LOGADO
        $sql = "SELECT id_jogo, jogo, nota FROM tb_jogos 
                WHERE usuario_id = $id";

        $resultado = mysqli_query($conn, $sql);

        $linhas = mysqli_affected_rows($conn);

        if ($linhas < 0) {
            exit("<h3>Erro ao buscar jogo do usuário. 
            Tente novamente mais tarde, ou contate o suporte</h3>");
        }

        if ($linhas == 0) {
            exit("<h3>Você não tem jogos cadastrados!</h3>");
        }

        echo '<div class="row">';
        echo '<div class="col col-md-4">';
        echo '<table class="table table-striped">';

        while ($jogo_atual = mysqli_fetch_assoc($resultado)) {
            echo '<tr>';
            echo    '<td>'.$jogo_atual['jogo'].'</td>';
            echo    '<td>';
            echo    '<td> Nota: '.$jogo_atual['nota'].'</td>';
            echo    '<td>';
            echo        '<a href="deletar_jogo.php?id_jogo=';
            echo            $jogo_atual['id_jogo'];
            echo        '" class="btn btn-outline-danger btn-sm" style="margin-right: 10px;">X</a>';
            echo        '<a href="editar_jogo.php?id_jogo=';
            echo            $jogo_atual['id_jogo'];
            echo        '" class="btn btn-outline-success btn-sm">editar</a>';
            echo    '</td>';
            echo '</tr>';
        }
        

        echo '</table>';
        echo '</div>';
        echo '</div>';
    
    ?>

    
</body>
</html>