<?php
include("conexao.php");

// Sanitização e Validação de Entrada
$id = filter_var($_POST['id'], FILTER_VALIDATE_INT);

// Verificação se o ID é válido
if ($id === false) {
    ?>
    <script>
    alert("ID inválido!");
    </script>
    <?php
    exit();
}

// Consulta Preparada para Exclusão
$sql_code = "DELETE FROM livraria.livros
             WHERE id = ?";

$stmt = $mysqli->prepare($sql_code);
$stmt->bind_param('i', $id);

if ($stmt->execute()) {
    ?>
    <script>
    alert("Deletado com Sucesso!");
    </script>
    <?php
} else {
    ?>
    <script>
    alert("Algo deu errado. Tente novamente!");
    </script>
    <?php
}

// Fechar declaração
$stmt->close();
?>
