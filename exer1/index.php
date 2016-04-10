<?php
//Grupo: Willian Serafini, Gabriel Calderaro e Samantha Machado

$valorDeEntrada = '';
if (isset($_POST['entrada']) && !empty($_POST['entrada'])) { // se preencheu o campo de entrada do formulario
    $valorDeEntrada = $_POST['entrada'];
    
    //lista dos lexemas
    $lista_tokens_lexemas = array(
        'NUMERO_FIXO' => '/^\(\d{2}\)\d{4}\-\d{4}$/', //ex: (51)9766-5131
        'PLACA_CARRO' => '/^[A-Z]{3}\-\d{4}$/', // ex: ABC-1234
        'ISBN_LIVRO' => '/^\d{3}\-\d{2}\-\d{5}\-\d{2}\-\d$/', //ex: 978-85-88639-24-9        
        'IP_VALIDO' => '/^(([1]?[0-9]{1,2}|2([0-4][0-9]|5[0-5])).){3}([1]?[0-9]{1,2}|2([0-4][0-9]|5[0-5]))$/', //ex: 128.6.4.7
        'ESTACAO_RADIO' => '/^\d{3}\.\d{1}$/', // ex: 105.1
        'NUMEROS_ROMANOS' => '/^[IVXLCDM]+$/', // ex: XX
        'MATRICULA_UNISC' => '/^m\d{5}$/', //m77611
        'NUMEROS_REAIS' => '/^[+-]?((\d+|\d{1,3}(\.\d{3})+)(\,\d*)?|\,\d+)$/', //ex: 55,5
        'URL_WEB' => '/^[w]{3}\.\w+\.[com]{3}\.[br]{2}$/', //ex: www.google.com.br
        'STRING_C' => '/^["]{1}\w+\["]{1}$/' //ex: "Ola Mundo"
    );

    $lexemaDaEntrada = '';
    foreach ($lista_tokens_lexemas as $nomeLexema => $regraLexema) { //percorre o array dos lexemas
        if (preg_match($regraLexema, $valorDeEntrada)) { // ve se a regra do lexema bate com valor de entrada
            $lexemaDaEntrada = $nomeLexema; // variavel recebe o nome do lexema
        }
    }
}
?>

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

        <title>Exercicío Aula 5 de Compiladores</title>
    </head>

    <body>
        <div style="margin: 0 auto; width: 600px;">
            <h2>Exercicío Aula 5 de Compiladores</h2><br/><br/>
            <form action="" method="post">
                <div>
                    <label>Entrada:</label><input value="<?= $valorDeEntrada ?>"  name="entrada" type="text" /><br/><br/>
                    <input type="submit" value="Calcular" />
                </div>
            </form><br/><br/>

            <?php
            if (isset($lexemaDaEntrada)) {
                echo '<strong>Lexema: ' . $lexemaDaEntrada . '</strong>'; // imprime valor de $lexemaDaEntrada
            }
            ?>
        </div>
    </body>
</html>