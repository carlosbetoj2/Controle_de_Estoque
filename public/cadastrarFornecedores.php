<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validação dos dados recebidos (exemplo básico)
    $nomeFornecedor = $_POST["nomeFornecedor"];
    $emailFornecedor = $_POST["emailFornecedor"];
    $contatoFornecedor = $_POST["contatoFornecedor"];
    $enderecoFornecedor = $_POST["enderecoFornecedor"];
    $cnpjFornecedor = $_POST["cnpjFornecedor"];

    // Verifica se todos os campos foram preenchidos
    if (empty($nomeFornecedor) || empty($emailFornecedor) || empty($contatoFornecedor) || empty($enderecoFornecedor) || empty($cnpjFornecedor)) {
        $response = array("status" => "error", "message" => "Todos os campos são obrigatórios.");
    } else {
        // Validação adicional (exemplo: validar o formato do email e CNPJ)
        if (!filter_var($emailFornecedor, FILTER_VALIDATE_EMAIL)) {
            $response = array("status" => "error", "message" => "Por favor, insira um e-mail válido.");
        } elseif (!preg_match('/^\(\d{2}\) \d{4,5}-\d{4}$/', $contatoFornecedor)) {
            $response = array("status" => "error", "message" => "Por favor, insira um contato válido no formato (xx) xxxxx-xxxx.");
        } elseif (!preg_match('/^\d{2}\.\d{3}\.\d{3}\/\d{4}-\d{2}$/', $cnpjFornecedor)) {
            $response = array("status" => "error", "message" => "Por favor, insira um CNPJ válido no formato xx.xxx.xxx/xxxx-xx.");
        } else {
            // Simulação de salvar o fornecedor no array $fornecedores
            $fornecedoresFile = __DIR__ . '/../inc/fornecedores.php';
            include_once $fornecedoresFile;

            // Gerar novo ID
            $novoId = count($fornecedores) > 0 ? end($fornecedores)['id'] + 1 : 1;

            $novoFornecedor = array(
                "id" => $novoId,
                "nome" => $nomeFornecedor,
                "email" => $emailFornecedor,
                "contato" => $contatoFornecedor,
                "endereco" => $enderecoFornecedor,
                "cnpj" => $cnpjFornecedor
            );

            // Adicionar o novo fornecedor ao array $fornecedores
            $fornecedores[] = $novoFornecedor;

            // Salvar o array $fornecedores de volta no arquivo fornecedores.php
            file_put_contents($fornecedoresFile, '<?php $fornecedores = ' . var_export($fornecedores, true) . ';');

            // Retornar mensagem de sucesso
            $response = array("status" => "success", "message" => "Fornecedor cadastrado com sucesso!", "data" => $novoFornecedor, "fornecedores" => $fornecedores);
        }
    }

    // Retorna a resposta em JSON
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
