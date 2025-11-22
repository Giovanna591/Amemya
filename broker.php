//broker.php
<?php
require_once('phpMQTT.php');

// Configurações do broker público (HiveMQ)
$server = 'broker.hivemq.com';
$port = 1883;
$username = '';
$password = '';
$client_id = 'replit_publicador_' . rand();
$topico = 'testes/amemiya';

$mqtt = new Bluerhinos\phpMQTT($server, $port, $client_id);

?>