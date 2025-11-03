// EngIII/cadastro.php (Lógica de Cadastro)
<?php
include 'conexao.php'; 
session_start();

$nome_usuario = trim($_POST['nome_cadastro'] ?? '');
$email = trim($_POST['email_cadastro'] ?? '');
$senha_bruta = $_POST['senha_cadastro'] ?? '';
$url_retorno = 'cadastrar-login.html';

// Validações...
if (empty($nome_usuario) || empty($email) || empty($senha_bruta) || strlen($senha_bruta) < 6) {
    header("Location: $url_retorno?status=erro&msg=Preencha todos os campos e use senha mínima de 6 caracteres.");
    exit;
}

// Cria a hash da senha
$senha_hash = password_hash($senha_bruta, PASSWORD_DEFAULT);

try {
    // 1. Verifica duplicidade
    $stmt_check = $pdo->prepare("SELECT COUNT(*) FROM usuarios WHERE nome = :nome OR email = :email");
    $stmt_check->execute(['nome' => $nome_usuario, 'email' => $email]);
    if ($stmt_check->fetchColumn() > 0) {
         header("Location: $url_retorno?status=erro&msg=Nome de usuário ou email já cadastrado.");
         exit;
    }

    // 2. Inserção no banco de dados
    $sql = "INSERT INTO usuarios (nome, email, senha_hash, data_cadastro) 
            VALUES (:nome, :email, :senha_hash, NOW())";
    
    $stmt_insert = $pdo->prepare($sql);
    $stmt_insert->execute([
        'nome' => $nome_usuario,
        'email' => $email,
        'senha_hash' => $senha_hash
    ]);
    
    // 3. Sucesso
    header("Location: login.html?status=sucesso&msg=Conta criada com sucesso! Faça login.");
    exit;

} catch (PDOException $e) {
    error_log("Erro no cadastro: " . $e->getMessage());
    header("Location: $url_retorno?status=erro&msg=Erro interno no servidor.");
    exit;
}
?>