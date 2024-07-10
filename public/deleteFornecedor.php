<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Verifica se o ID é maior ou igual a 10
    if ($id > 10) {
        // Inclui o array de fornecedores
        $fornecedoresFile = __DIR__ . '/../inc/fornecedores.php'; 
        include_once $fornecedoresFile;

        // Filtra os fornecedores para remover o fornecedor com o ID fornecido
        $fornecedores = array_filter($fornecedores, function($fornecedor) use ($id) {
            return $fornecedor['id'] != $id;
        });

        // Salvar o array atualizado de volta no arquivo fornecedores.php
        file_put_contents($fornecedoresFile, '<?php $fornecedores = ' . var_export($fornecedores, true) . ';');

        // Retornar mensagem de sucesso
        $response = array("status" => "success", "message" => "Fornecedor deletado com sucesso!");
    } else {
        // Retornar mensagem de erro se o ID for menor que 10
        $response = array("status" => "error", "message" => "Não é permitido excluir fornecedores com ID menor que 10.");
    }
} else {
    $response = array("status" => "error", "message" => "ID de fornecedor não fornecido.");
}

// Envia a resposta em formato JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
