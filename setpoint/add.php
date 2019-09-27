<?php

require_once 'init.php';

// pega os dados do formuário
$nome = isset($_POST['nome']) ? $_POST['nome'] : null;
$valor = isset($_POST['valor']) ? $_POST['valor'] : null;
$date_alt = isset($_POST['date_alt']) ? $_POST['date_alt'] : null;
$date_fim = isset($_POST['date_fim']) ? $_POST['date_fim'] : null;
$tag_ref = isset($_POST['tag_ref']) ? $_POST['tag_ref'] : null;
$area = isset($_POST['area']) ? $_POST['area'] : null;


// validação (bem simples, só pra evitar dados vazios)
if (empty($nome) || empty($valor) || empty($date_alt) || empty($date_fim) || empty($tag_ref)|| empty($area))
{
    echo "Volte e preencha todos os campos";
    exit;
}

// a data vem no formato dd/mm/YYYY
// então precisamos converter para YYYY-mm-dd
$isoDate = dateConvert($date_alt);
$isoDate = dateConvert($date_fim);

// insere no banco
$PDO = db_connect();
$sql = "INSERT INTO setpoint_db(nome, valor,date_alt,date_fim,tag_ref, area)
VALUES(:nome, :valor, :date_alt, :date_fim, :tag_ref, :area)";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':nome', $nome);
$stmt->bindParam(':valor', $valor);
$stmt->bindParam(':date_alt', $date_alt);
$stmt->bindParam(':date_fim', $date_fim);
$stmt->bindParam(':tag_ref', $tag_ref);
$stmt->bindParam(':area', $area);


if ($stmt->execute())
{
    header('Location: index.php');
}
else
{
    echo "Erro ao cadastrar";
    print_r($stmt->errorInfo());
}
