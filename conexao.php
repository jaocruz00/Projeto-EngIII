// EngIII/conexao.php
<?php
// Conexão com MySQL (XAMPP/Localhost)
$host = 'localhost'; 
$db   = 'conecta_jovem'; // Confirme se este é o nome do seu banco de dados no phpMyAdmin
$user = 'root';              
$pass = '';                  
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    // A variável $pdo é a conexão com o banco de dados
    $pdo = new PDO($dsn, $user, $pass, $options);
    
} catch (PDOException $e) {
    // Exibe o erro de conexão apenas se estiver em ambiente de desenvolvimento
    echo "Erro de conexão com o MySQL: " . $e->getMessage();
    exit();
}
?>