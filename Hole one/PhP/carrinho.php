<?php 
         session_start();
$total=0;
  if(!isset($_SESSION['carrinho'])){
$_SESSION['carrinho'] = array();
  }
      //adiciona produto

      if(isset($_GET['acao'])){
 //adiciona carrinho
          if($_GET['acao'] == 'add'){
   $id = intval ($_GET['id']);
          if(!isset($_SESSION['carrinho'][$id])){
              $_SESSION['carrinho'][$id] = 1;
              }else{
                  $_SESSION['carrinho'][$id] += 1;
              }


          }

          //REMOVER CARRINHO
          if($_GET['acao'] == 'del'){
              $id = intval ($_GET['id']);
            if(isset($_SESSION['carrinho'][$id])){
                unset($_SESSION['carrinho'][$id]);
                
                }
                
                
                }

          //ALTERAR QUANTIDADE

          if($_GET['acao'] == 'up'){
            if (isset($_POST['produto']) && is_array($_POST['produto'])){
            foreach($_POST['produto'] as $id => $qtd){
                $id = intval($id);
                $qtd = intval($qtd);
              if(!empty($qtd) || $qtd <> 0){
                  $_SESSION['carrinho'][$id] = $qtd;
              }else{
               unset($_SESSION['carrinho'][$id]);
              }

                
            }

              }

      }
              }
    
    //print_r($_SESSION['carrinho']);

    ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Pagamento</title>
    <link rel="stylesheet" href="pay2.css">
</head>
<body>
    <div class="container">
        <div class="left-panel">
            <div class="cart-items">
            </div>
            <div class="total">
            </div>
            <button class="btn-finalizar">Finalizar Compra</button>
        </div>
        <div class="right-panel">
            <div class="payment-method">
                <img src="img/icon-elo.png" alt="Elo">
                <img src="img/icon-mastercard.png" alt="MasterCard">
                <img src="img/icon-visa.png" alt="Visa">
            </div>
            <div class="card-info">
                <input type="text" id="card-number" placeholder="número do cartão*">
                
                <input type="text" id="card-name" placeholder="Nome do titular*">
                
                <div class="card-details">
                    <input type="text" id="state" placeholder="Estado*">
                    
                    <input type="text" id="year" placeholder="Ano*">
                    
                    <input type="text" id="cvv" placeholder="CVV*">
                </div>
                <select id="installments">
                    <option value="1">1x de R$ 300,00</option>
                    <option value="1">2x de R$ 150,00</option>
                </select>   
            <div class="end" >
                <button class="btn-finalizar">Cadastrar</button>
            </div>
            <form action="?acao=up" method="post">
        <tfoot>
<tr>
<tr>
    
    </tfoot>
        
        <tbody>
            </div>
            <div class="ende-postal">
            <label for="installments">Endereço Postal</label>
            </div>
            <div class="address">
            <div class="two">

                <input type="text" id="cep" placeholder="CEP">
                <input type="text" id="address" placeholder="Endereço">
            </div>
            <div class="two">

                <input type="text" id="complement" placeholder="Complemento">
                <input type="text" id="number" placeholder="Número">
            </div> 
                <div class="card-details">

                <input type="text" id="neighborhood" placeholder="Bairro">
                <input type="text" id="city" placeholder="Cidade">
                <input type="text" id="state-address" placeholder="Estado">

                </div> 
                
            </div>
            <label for="save-address">
                <input type="checkbox" id="save-address"> Endereço salvo
                 <td colspan="5"><a href="index.php">Continuar Comprando</a></td>
            </label>
        </div>
    </div>
<?php 
     if(count($_SESSION['carrinho']) == 0){
         echo '<tr><td colspan="5">Não há produto no carrinho</td></tr>';

            }else{

         require("conexao.php");
              foreach($_SESSION['carrinho'] as $id => $qtd){
              $sql = "SELECT * FROM carrinho WHERE id= '$id'";
$sql = "INSERT INTO carrinho (idcarrinho,idproduto,idusuario,idendereco,idpagamento,idfavoritos,produto,quantidade,subtotal) VALUES
  ('', '$idproduto', '$idusuario', '$idendereco', '$idpagamento','$idfavoritos', '$produto', '$quantidade','$subtotal')";

              $qr = mysqli_query($conexao,$sql) or die (mysqli_error());
              $ln = mysqli_fetch_assoc($qr);

             $nome = $ln['nome'];
             $preco = number_format ($ln['preco'], 2, ', ', '.');
             $sub = $ln['preco'] * $qtd;
                  
            $total += $sub;

            echo '<tr>
    
<td>'.$nome.'</td>
<td> <input type="text" size="3" name="prod['.$id.']" value="'.$qtd.'" /></td>
<td>R$ '.$preco.'</td>
<td>R$ '.$sub.'</td>
<td><a href="?acao=del&id='.$id.'">Remove</a></td>
    </tr>';
                     }
         $total = number_format($total, 2, ',', '.');
         echo '<tr>
         
         <td colspan="4">Total</td>
         <td>R$ '.$total.' </td>
         
         
        </tr>';

            }
            
            
            
            
            ?>  
    <!--
<tr>
    
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
    
</tr>
      -->
        </tbody>
        </form>
        
</table>
    
</body>
<html>