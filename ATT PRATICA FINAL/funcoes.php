<?php 

function form_nao_enviado() {
    return $_SERVER['REQUEST_METHOD'] !== 'POST';
}

function form_em_branco() {
    return empty($_POST['usuario']) || empty($_POST['senha']);
}

function jogo_em_branco() {
    return empty($_POST['jogo']) || empty($_POST['nota']);
}


function tratar_erros () {

    if (!isset($_GET['code'])) {
        return;
    }

    $code = (int)$_GET['code'];

    switch($code) {

        case 0: 
            $erro = '<h3>Você não n deveria tentar acessar essaa página 0-0</h3>';
            break;
        
        case 1:
            $erro = '<h3>Usuário ou senha estão errados fih. Tente novamente mais tarde!</h3>';
            break;

        case 2:
            $erro = '<h2>Preenche o Form todo né pô</h2>';
            break;

        case 3:
            $erro = '<h3>Erro ao executar consulta ao banco de dados. 
                    Tente novamente mais tarde, ou contate o suporte kkkkkkk</h3>';
            break;

        case 4:
            $erro = '<h3>Erro ao "Bindar parametros"</h3>';

            break;

        case 5:
            $erro = '<h3>Erro ao executar stmt SQL</h3>';

            break;

        case 6:
        $erro = '<h3>Email ja cadastrado! Doido usa outro</h3>';

        break;

        default:
            $erro = "";
            break;
    }

    echo $erro;


}

?>