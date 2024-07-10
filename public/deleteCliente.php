<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Verifica se o ID é maior ou igual a 10
    if ($id > 10) {
        // Inclui o array de clientes
        $clientesFile = __DIR__ . '/../inc/clientes.php'; 
        include_once $clientesFile;

        // Filtra os clientes para remover o cliente com o ID fornecido
        $clientes = array_filter($clientes, function($cliente) use ($id) {
            return $cliente['id'] != $id;
        });

        // Salvar o array atualizado de volta no arquivo clientes.php
        file_put_contents($clientesFile, '<?php $clientes = ' . var_export($clientes, true) . ';');

        // Retornar mensagem de sucesso
        $response = array("status" => "success", "message" => "Cliente deletado com sucesso!");
    } else {
        // Retornar mensagem de erro se o ID for menor que 10
        $response = array("status" => "error", "message" => "Não é permitido excluir clientes com ID menor que 10.");
    }
} else {
    $response = array("status" => "error", "message" => "ID de cliente não fornecido.");
}

// Envia a resposta em formato JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
