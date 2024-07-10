<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validação dos dados recebidos (exemplo básico)
    $nomeCliente = $_POST["nomeCliente"];
    $emailCliente = $_POST["emailCliente"];
    $contatoCliente = $_POST["contatoCliente"];
    $enderecoCliente = $_POST["enderecoCliente"];
    $cpfCliente = $_POST["cpfCliente"];

    // Verifica se todos os campos foram preenchidos
    if (empty($nomeCliente) || empty($emailCliente) || empty($contatoCliente) || empty($enderecoCliente) || empty($cpfCliente)) {
        $response = array("status" => "error", "message" => "Todos os campos são obrigatórios.");
    } else {
        // Validação adicional (exemplo: validar o formato do email e CPF)
        if (!filter_var($emailCliente, FILTER_VALIDATE_EMAIL)) {
            $response = array("status" => "error", "message" => "Por favor, insira um e-mail válido.");
        } elseif (!preg_match('/^\(\d{2}\) \d{4,5}-\d{4}$/', $contatoCliente)) {
            $response = array("status" => "error", "message" => "Por favor, insira um contato válido.");
        } elseif (!preg_match('/^\d{3}\.\d{3}\.\d{3}-\d{2}$/', $cpfCliente)) {
            $response = array("status" => "error", "message" => "Por favor, insira um CPF válido.");
        } else {
            // Simulação de salvar o fornecedor no array $fornecedores
            $fornecedoresFile = __DIR__ . '/../inc/fornecedores.php';
            include_once $fornecedoresFile;

            // Gerar novo ID
            $novoId = count($fornecedores) > 0 ? end($fornecedores)['id'] + 1 : 1;
            
            $novoCliente = array(
                "id" => $novoId,
                "nome" => $nomeCliente,
                "email" => $emailCliente,
                "contato" => $contatoCliente,
                "endereco" => $enderecoCliente,
                "cpf" => $cpfCliente
            );

            // Incluir o novo cliente no array $clientes
            $clientesFile = __DIR__ . '/../inc/clientes.php'; // Caminho completo para o arquivo clientes.php
            include_once $clientesFile;

            // Adicionar o novo cliente ao array $clientes
            $clientes[] = $novoCliente;

            // Salvar o array $clientes de volta no arquivo clientes.php
            file_put_contents($clientesFile, '<?php $clientes = ' . var_export($clientes, true) . ';');

            // Retornar mensagem de sucesso e os clientes atualizados
            $response = array("status" => "success", "message" => "Cliente cadastrado com sucesso!", "clientes" => $clientes);
        }
    }

    // Retorna a resposta em JSON
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
