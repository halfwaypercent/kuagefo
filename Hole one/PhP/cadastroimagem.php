<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Imagem</title>
</head>
<body>
<form name="imagem" action="" method="post" enctype="multipart/form-data">

    idesporte: <input type="text" name="idesporte"><br>
 
    produto: <input type="text" name="produto"><br>
    tamanho: <input type="text" name="tamanho"><br>
    quantidade: <input type="text" name="quantidade"><br>
    precounitario: <input type="text" name="precounitario"><br>
    <input type="file" name="imge" value="Imagens"><br>
    <input type="submit" value="salvar" name="salvar">
</form>
<img src="imagens">
</body>
</html>
<?php
if (isset($_POST['salvar'])) {
    require("conexao.php");
    var_dump($_FILES['imge']);
$img=$_FILES['imge']['name']; 

$idesporte = $_POST['idesporte'];

$produto = $_POST['produto'];
$tamanho = $_POST['tamanho'];
$quantidade = $_POST['quantidade'];
$precounitario = $_POST['precounitario'];

$sql = "INSERT INTO produto (idproduto, idesporte,  produto, tamanho, quantidade, precounitario,img) VALUES
                                 ('','$idesporte', '$produto', '$tamanho', '$quantidade', '$precounitario','$img')";

$teste = mysqli_query($conexao, $sql);

$temp = $_FILES['imge']['tmp_name'];

move_uploaded_file($temp,"imagens/$img"); 
}
?>
