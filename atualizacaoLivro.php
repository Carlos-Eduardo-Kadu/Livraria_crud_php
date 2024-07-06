<?php
include("conexao.php");

// Sanitização e Validação de Entrada
$id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
$nomeLivro = mysqli_real_escape_string($mysqli, $_POST['nomeLivro']);
$nomeAutor = mysqli_real_escape_string($mysqli, $_POST['nomeAutor']);
$genero = mysqli_real_escape_string($mysqli, $_POST['genero']);
$data = mysqli_real_escape_string($mysqli, $_POST['data']);

// Verificação se o ID é válido
if ($id === false) {
    ?>
    <script>
    $("#alerta").html("ID inválido!");
    $(".alert").addClass("alert-warning");
    $(".alert").removeClass("alert-success");
    </script>
    <?php
    exit();
}

// Preparar e Executar Consulta SQL
$sql_code = "UPDATE livraria.livros
             SET nome_autor=?, 
                 data_publi=?, 
                 data_auteracao=NOW(), 
                 genero=?, 
                 nome_livro=?
             WHERE id=?";

$stmt = $mysqli->prepare($sql_code);
$stmt->bind_param('ssssi', $nomeAutor, $data, $genero, $nomeLivro, $id);

if ($stmt->execute()) {
    ?>
    <script>
    $("#alerta").html('O Livro Foi Atualizado com Sucesso! <i class="fa-regular fa-circle-check"></i>');
    $("#recebe_tabela").load("encheTabela.php", {});
    </script>
    <?php
} else {
    ?>
    <script>
    $("#alerta").html("Houve um erro na atualização do livro!");
    $(".alert").addClass("alert-warning");
    $(".alert").removeClass("alert-success");
    </script>
    <?php
}

// Fechar declaração
$stmt->close();
?>
