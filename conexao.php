<?php 
$hostname = "localhost";
$bancoDeDados = "";
$usuario = "root";
$senha = "";

// Verificar se as constantes já estão definidas
if (!defined('DB_HOST')) {
    define('DB_HOST', $hostname);
}
if (!defined('DB_NAME')) {
    define('DB_NAME', $bancoDeDados);
}
if (!defined('DB_USER')) {
    define('DB_USER', $usuario);
}
if (!defined('DB_PASS')) {
    define('DB_PASS', $senha);
}

// Objeto PHP mysqli
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if($mysqli->connect_errno) {
    error_log("Falha na conexão com o banco de dados: " . $mysqli->connect_error);
    die("Ocorreu um problema na conexão com o banco de dados. Por favor, tente novamente mais tarde.");
} else {
    echo"<div style='display:none;'>conectado</div>";
}
?>
