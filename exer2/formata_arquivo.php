<?php

if (isset($_FILES['entrada']) && !empty($_FILES['entrada'])) { // se upou um arquivo
    $arquivo = $_FILES['entrada'];
    
    try {
        if (!move_uploaded_file($arquivo['tmp_name'], 'tmp/arquivo_formatado.txt')) { // tenta mover o arquivo para a pasta selecionada
            throw new Exception('Não foi possível mover o arquivo!');
        }
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }

    $arquivoUpado = 'tmp/arquivo_formatado.txt';
    $linhasDoArquivo = file($arquivoUpado); // coloca as linhas do txt em um array
    $arquivoFormatado = '';
    foreach ($linhasDoArquivo as $linha) {
        $expressaoRegular = '/\s{2,}/'; // procurar por uma sequencia de espaços
        $trocarPor = ' '; // troca por 1 espaço
        $arquivoFormatado .= preg_replace($expressaoRegular, $trocarPor, $linha); // faz a troca
    }

    file_put_contents($arquivoUpado, $arquivoFormatado); // coloca no arquivo o texto formatado
    
    //linhas abaixo servem para forçar o download do arquivo formatado .txt
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . basename($arquivoUpado));
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($arquivoUpado));
    readfile($arquivoUpado);
}
?>