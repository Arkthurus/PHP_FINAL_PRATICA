<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ATT PRATICA FINAL - Meus Jogos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>
<body class="container">
    
    <h1>ATT PRATICA FINAL - Meus Jogos - Login</h1>

    <h2>Informe os dados para login:</h2>
    
    <?php 
    // Inicia a sessão PHP para poder acessar variáveis de sessão
    session_start();

    // Verifica se existe uma variável de sessão chamada 'mensagem'
    if (isset($_SESSION['mensagem'])) {  
        echo '<div><h2>' . $_SESSION['mensagem'] . '</h2></div>';// Exibe a mensagem armazenada dentro de uma tag <div> e <h2>
        unset($_SESSION['mensagem']);// Remove a variável de sessão 'mensagem' para que ela não apareça novamente ao recarregar a página
    }
        require_once 'funcoes.php';

        errorsTreatment();   
    
    ?>


    <form action="verify.php" method="post">

        <p>
            <label for="usuario">Usuário:</label><br>
            <input type="text" name="usuario" id="usuario">
        </p>

        <p>
            <label for="senha">Senha:</label><br>
            <input type="password" name="senha" id="senha">
        </p>

        <button type="submit" class="btn btn-success">Login</button>

    </form>
    <br>
    <a href="cadastrarUser.php"><button class="btn btn-success">Cadastrar Novo Usuario</button></a>

</body>
</html>