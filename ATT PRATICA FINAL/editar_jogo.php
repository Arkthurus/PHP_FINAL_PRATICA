<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Jogo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container">
    <h1>Editar Jogo</h1>
    <?php
        require_once 'lock.php'; // Garante que o usuário está autenticado/logado
        require_once 'funcoes.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (blankGame()) {
                header('location:home.php?code=2');
                die;
            }

            if (!NumInput()) {//Verifica se o campo "nota" n é numerico
                header('location:home.php?code=7');
                die;
            }

        }

        if (!isset($_GET['id_jogo'])) { // Verifica se o parâmetro id_jogo foi passado via GET
            header('location:home.php?code=0'); // Redireciona para home.php com código de erro se não houver id_jogo
            die; // Encerra a execução do script
        }

        $id_jogo = (int)$_GET['id_jogo']; // Obtém o id_jogo da URL e converte para inteiro

        require_once 'conexao.php'; // Inclui o arquivo para conectar ao banco de dados

        $conn = conectar_banco(); // Cria a conexão com o banco e armazena em $conn
        $id_usuario = $_SESSION['id']; // Pega o id do usuário logado da sessão

        if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Verifica se o formulário foi enviado via POST
            // O nome do jogo vem do formulário
            $novo_nome = mysqli_real_escape_string($conn, $_POST['jogo']); // Pega o novo nome do jogo do POST e faz proteção contra SQL Injection
            $nova_nota = mysqli_real_escape_string($conn, $_POST['nota']);
            // UPDATE usando o id do jogo vindo do GET
            $sql = "UPDATE tb_jogos SET jogo = '$novo_nome', nota = '$nova_nota' WHERE id_jogo = $id_jogo AND usuario_id = $id_usuario"; // Monta o SQL para atualizar o jogo
            mysqli_query($conn, $sql); // Executa o comando SQL

            $linhas = mysqli_affected_rows($conn); // Verifica quantas linhas foram afetadas pelo UPDATE

            if ($linhas <= 0) { //nenhuma linha foi alterada(n houve modificação)
                header('location:home.php'); // Redireciona para home.php
                die; // Encerra o script
            }
            header('location:home.php'); // Se deu certo, redireciona para home.php com as modificações
            die; // Encerra o script
        }

        // Buscar o nome atual do jogo para mostrar no formulário
        $sql = "SELECT jogo, nota FROM tb_jogos WHERE id_jogo = $id_jogo AND usuario_id = $id_usuario"; // Monta o SQL para buscar o nome atual do jogo
        $resultado = mysqli_query($conn, $sql); // Executa o SELECT
        $jogo = mysqli_fetch_assoc($resultado); // Pega o resultado como array associativo

        if (!$jogo) { // Se não encontrar o jogo, algo está errado (jogo não existe ou não pertence ao usuário)
            header('location:home.php?code=4'); // Redireciona para home.php com código de erro 4
            die; // Encerra o script
        }
    ?>
    <form method="post">
        <div class="mb-3">
            <label for="jogo" class="form-label">Nome do Jogo</label>
            <input type="text" class="form-control" id="jogo" name="jogo" value="<?= htmlspecialchars($jogo['jogo']) ?>" required><br>
            <label for="nota" class="form-label">Nota do Jogo</label>
            <input type="number" class="form-control" id="nota" name="nota" value="<?= htmlspecialchars($jogo['nota'])?>" >
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="home.php" class="btn btn-secondary">Cancelar</a>
    </form>
</body>
</html>