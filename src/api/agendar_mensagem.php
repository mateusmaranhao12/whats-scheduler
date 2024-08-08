<?php
require 'cors.php';        // Habilita CORS
require 'db_config.php';   // Conecta ao banco de dados

// Receber dados via POST
$data = json_decode(file_get_contents("php://input"), true);

// Verificar se o JSON foi decodificado corretamente
if (!$data) {
    die(json_encode(["success" => false, "error" => "Erro ao decodificar o JSON ou JSON vazio."]));
}

// Extrair e validar os dados
$numero_whatsapp = $data['numero_whatsapp'] ?? null;
$mensagem = $data['mensagem'] ?? null;
$horario_envio = $data['horario_envio'] ?? null;

if (!$numero_whatsapp || !$mensagem || !$horario_envio) {
    die(json_encode(["success" => false, "error" => "Os campos número WhatsApp, mensagem e horário de envio são obrigatórios."]));
}

// Inserir dados no banco de dados
$sql = "INSERT INTO mensagens_agendadas (numero_whatsapp, mensagem, horario_envio) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);

// Verificar se a preparação da consulta foi bem-sucedida
if (!$stmt) {
    die(json_encode(["success" => false, "error" => "Erro ao preparar a consulta: " . $conn->error]));
}

$stmt->bind_param("sss", $numero_whatsapp, $mensagem, $horario_envio);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => $stmt->error]);
}

$stmt->close();
$conn->close();
