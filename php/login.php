<?php
$conexao = require("conexao.php");
if (isset($_POST["Logar"])){ 
    $email=$_POST["email"];
    $senha=$_POST["senha"];

    $sql="INSERT INTO cadastro (email,senha) VALUES
    ('$email','$senha')";
    $resultado = mysqli_query($conexao,$sql);
    if ($resultado){ echo "registro cadastrado" ;}
               else { echo "registro não cadatrado";}
    }
    ?>




2 php para teste de login
<?php
session_start(); // Inicia a sessão

// Conexão com o banco de dados
$conexao = new mysqli("host", "usuario", "senha", "banco");

// Verifica a conexão
if ($conexao->connect_error) {
    die("Conexão falhou: " . $conexao->connect_error);
}

// Obtém os dados do formulário
$email = $_POST['email'];
$senha = $_POST['senha'];

// Prepara a consulta para verificar o usuário
$stmt = $conexao->prepare("SELECT id, senha FROM usuarios WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result(); // Armazena o resultado da consulta

// Verifica se o email existe
if ($stmt->num_rows > 0) {
    $stmt->bind_result($id, $senha_hash); // Vincula as colunas retornadas
    $stmt->fetch(); // Obtém os dados

    // Verifica a senha
    if (password_verify($senha, $senha_hash)) {
        // Senha correta
        $_SESSION['user_id'] = $id; // Armazena o ID do usuário na sessão
        echo "Login realizado com sucesso!";
        // Redirecione ou faça algo após o login
    } else {
        // Senha incorreta
        echo "Senha incorreta!";
    }
} else {
    // Email não encontrado
    echo "Email não encontrado!";
}

// Fecha a declaração e a conexão
$stmt->close();
$conexao->close();
?>
