<?php
// select.php — mostra a situação dos cursos de um funcionário específico

require('banco.php');

// ID do funcionário (pode vir via GET, POST ou fixo para teste)
$matricula = 'M001A'; // substitui por $_GET['matricula'] se quiser passar pela URL

$tableName = "Formacao";
$sql_select = "SELECT idCurso, situacao FROM {$tableName} WHERE matricula = '{$matricula}'";

$data = [];
$result_select = $conn->query($sql_select);

if ($result_select && $result_select->num_rows > 0) {
    while ($row = $result_select->fetch_assoc()) {
        $data[] = [
            "curso" => $row['idCurso'],
            "situacao" => $row['situacao']
        ];
    }
    $status = "success";
    $message = "Cursos encontrados para a matrícula {$matricula}.";
} else {
    $status = "empty";
    $message = "Nenhum curso encontrado para a matrícula {$matricula}.";
    $data = [];
}

$result_select?->free();
?>
