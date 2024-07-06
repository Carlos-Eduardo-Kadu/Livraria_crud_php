<?php
include("conexao.php");

// Sanitização e Validação de Entrada
$nomeLivro = mysqli_real_escape_string($mysqli, $_POST['nomeLivro']);
$nomeAutor = mysqli_real_escape_string($mysqli, $_POST['nomeAutor']);
$genero = mysqli_real_escape_string($mysqli, $_POST['genero']);
$data = mysqli_real_escape_string($mysqli, $_POST['data']);

// Consulta Preparada para Inserção
$sql_code = "INSERT INTO livraria.livros
             (nome_autor, data_publi, data_inclusao, genero, nome_livro)
             VALUES (?, ?, NOW(), ?, ?)";

$stmt = $mysqli->prepare($sql_code);
$stmt->bind_param('ssss', $nomeAutor, $data, $genero, $nomeLivro);

if ($stmt->execute()) {
    ?>
    <script>
        $("#alerta").html('O Livro Foi Cadastrado com Sucesso! <i class="fa-regular fa-circle-check"></i>');
        $("#recebe_tabela").load("encheTabela.php", {});
    </script>
    <?php
} else {
    ?>
    <script>
        $("#alerta").html("Houve um erro no cadastro do livro!");
        $(".alert").addClass("alert-warning");
        $(".alert").removeClass("alert-success");
    </script>
    <?php
}

// Fechar declaração
$stmt->close();
?>
