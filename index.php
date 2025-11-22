<?php
// index.php
require_once('phpMQTT.php');
require('broker.php');
require('banco.php');
require('select.php');

function processaMensagem($topic, $msg) {
    echo "\n📩 Mensagem recebida em $topic: $msg\n";
}

echo "Tentando conectar ao broker MQTT...\n";

if ($mqtt->connect(true, NULL, $username, $password)) {

    // --- PUBLICA ---
    $response = [
        "status" => $status ?? "error",
        "message" => $message ?? "Erro ao buscar IDs",
        "count" => $result_select->num_rows ?? 0,
        "ids" => $data ?? [] // agora só IDs
    ];

    $mensagem = json_encode($response, JSON_UNESCAPED_UNICODE);

    $mqtt->publish($topico, $mensagem, 0);
    echo "✅ Mensagem publicada em $topico: $mensagem\n";

    // --- ASSINA E ESCUTA ---
    $mqtt->subscribe([$topico => ["qos" => 0, "function" => "processaMensagem"]]);

    $inicio = time();
    while ($mqtt->proc() && (time() - $inicio < 30)) {
        // mantém a conexão ativa enquanto escuta respostas
    }

    $mqtt->close();
} else {
    echo "❌ Falha na conexão com o broker.\n";
}

$conn->close();
?>
