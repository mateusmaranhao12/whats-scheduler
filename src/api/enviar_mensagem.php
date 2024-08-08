<?php
require 'cors.php';        // Habilita CORS
require 'db_config.php';   // Conecta ao banco de dados
require 'vendor/autoload.php'; // Inclua o autoloader do Composer para a biblioteca do Twilio

use Twilio\Rest\Client;

// Selecionar mensagens agendadas que ainda não foram enviadas e cuja hora já chegou
$sql = "SELECT * FROM mensagens_agendadas WHERE enviado = 0 AND horario_envio <= NOW()";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $numero_whatsapp = $row['numero_whatsapp'];
        $mensagem = $row['mensagem'];

        // Enviar mensagem via API do Twilio
        $response = enviarMensagemWhatsApp($numero_whatsapp, $mensagem);

        if ($response['success']) {
            // Marcar como enviado
            $update_sql = "UPDATE mensagens_agendadas SET enviado = 1 WHERE id = ?";
            $stmt = $conn->prepare($update_sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
        } else {
            // Tratar erro de envio (log, notificação, etc.)
            error_log("Erro ao enviar mensagem para $numero_whatsapp: " . $response['error']);
        }
    }
}

$conn->close();

function enviarMensagemWhatsApp($numero, $mensagem)
{
    // Substitua com suas credenciais Twilio
    $sid = "AC89738024c4628ba3a596502f839e90a3";
    $token = "68c76ccb823c06233085f2a0d59df247";
    $twilio_number = "+5579991762846"; // Exemplo: +14155238886
    $client = new Client($sid, $token);

    try {
        $message = $client->messages->create(
            "whatsapp:$numero",
            array(
                'from' => "whatsapp:$twilio_number",
                'body' => $mensagem
            )
        );
        return ['success' => true];
    } catch (Exception $e) {
        return ['success' => false, 'error' => $e->getMessage()];
    }
}
