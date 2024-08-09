<?php
require 'vendor/autoload.php'; // Inclua o autoloader do Composer

use Dotenv\Dotenv;

// Carregar variáveis do arquivo .env
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Acessar variáveis de ambiente
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "whats_scheduler";

$twilio_sid = $_ENV['TWILIO_SID'];
$twilio_token = $_ENV['TWILIO_TOKEN'];
$twilio_number = $_ENV['TWILIO_WHATSAPP_NUMBER'];

// Conectar ao banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}