<?php

/**
 * Conecta com o POSTGRES usando PDO
 */
function db_connect()
{

    $PDO = new PDO('pgsql:host=' . DB_HOST . ';port=5432 ;dbname=' . DB_NAME .
    ';user=' . DB_USER .';password=' . DB_PASS  );


/* TESTE DE CONEXAO DIRETA
    $PDO = new PDO('pgsql:host=localhost;port=5432;dbname=postgres;user=postgres;password=P@ssw0rd');
*/

    return $PDO;
}


/**
 * Converte datas entre os padrões ISO e brasileiro
 * Fonte: http://rberaldo.com.br/php-conversao-de-datas-formato-brasileiro-e-formato-iso/
 */
function dateConvert($date)
{
    if ( ! strstr( $date, '/' ) )
    {
        // $date está no formato ISO (yyyy-mm-dd) e deve ser convertida
        // para dd/mm/yyyy
        sscanf($date, '%d-%d-%d %d:%d', $y, $m, $d, $h, $mi);
        return sprintf('%02d/%02d/%04d | %02d:%02d', $d, $m, $y, $h, $mi);
    }
    else
    {
        // $date está no formato brasileiro e deve ser convertida para ISO
        sscanf($date, '%d-%d-%d %d:%d', $y, $m, $d, $h, $mi);
        //sscanf($date, '%d/%d/%d %d:%d', $d, $m, $y, $h, $mi);
        return sprintf('%02d/%02d/%04d | %02d:%02d', $d, $m, $y, $h, $mi);
    }



    return false;
}
