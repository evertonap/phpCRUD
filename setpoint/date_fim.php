<?php

require_once 'init.php';

// resgata os valores do formulário
//$nome = isset($_POST['nome']) ? $_POST['nome'] : null;
//$valor = isset($_POST['valor']) ? $_POST['valor'] : null;
$date_fim = isset($_POST['date_alt']) ? $_POST['date_alt'] : null;
//$date_fim = isset($_POST['date_fim']) ? $_POST['date_fim'] : null;
//$tag_ref = isset($_POST['tag_ref']) ? $_POST['tag_ref'] : null;
//$area = isset($_POST['area']) ? $_POST['area'] : null;
$id = isset($_POST['id']) ? $_POST['id'] : null;

// validação (bem simples, mais uma vez)
if (empty($date_alt))
{
    echo "Volte e tente novamente";
    exit;
}

// a data vem no formato dd/mm/YYYY
// então precisamos converter para YYYY-mm-dd
//$isoDate = dateConvert($birthdate);

// atualiza o banco
$isoDate = dateConvert($date_alt);
//$isoDate = dateConvert($date_fim);

$PDO = db_connect();
$sql = "UPDATE setpoint_db
SET date_alt= :date_alt WHERE id = :id";
//$sql = "UPDATE setpoint_db
//SET nome='Consumo Energia kWh', valor= 100, date_alt= '2019-06-18T09:36', date_fim= '2019-06-20T10:36', tag_ref= '[H_9830A009_1]TT_QGBT_01', area= 'Utilidades'
//WHERE id = 2";

$stmt = $PDO->prepare($sql);
//$stmt->bindParam(':nome', $nome);
//$stmt->bindParam(':valor', $valor);
$stmt->bindParam(':date_alt', $date_alt);
//$stmt->bindParam(':date_fim', $date_fim);
//$stmt->bindParam(':tag_ref', $tag_ref);
//$stmt->bindParam(':area', $area);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);

if ($stmt->execute())
{
    header('Location: index.php');
}
else
{
    echo "Erro ao alterar";
    print_r($stmt->errorInfo());
}

