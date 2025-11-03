// EngIII/login.php (Lógica de Autenticação)
<?php
// Inclui o arquivo de conexão
include 'conexao.php'; 

session_start();

$nome = $_POST['nome'] ?? '';
$senha = $_POST['senha'] ?? '';

// 1. Busca o hash da senha no banco de dados
try {
    $stmt = $pdo->prepare("SELECT nome, senha_hash FROM usuarios WHERE nome = :nome");
    $stmt->execute(['nome' => $nome_usuario]);
    $usuario = $stmt->fetch();
    
    $login_sucesso = false;
    
    if ($usuario) {
        // 2. Verifica se a senha digitada corresponde ao hash no DB
        if (password_verify($senha_digitada, $usuario['senha_hash'])) {
            $login_sucesso = true;
            // Armazena o nome de usuário na sessão
            $_SESSION['usuario_logado'] = $usuario['nome'];
        }
    }

} catch (PDOException $e) {
    error_log("Erro ao buscar usuário: " . $e->getMessage());
    header("Location: login.html?status=erro&msg=Erro interno. Tente novamente.");
    exit;
}

// 3. Redirecionamento
if ($login_sucesso) {
    // Redireciona para a página de cadastrar participante
    header("Location: pag2.html");
    exit;
} else {
    // Redireciona de volta para login com mensagem de erro
    header("Location: login.html?status=erro&msg=Usuário ou senha inválidos."); 
    exit;
}

?>