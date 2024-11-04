<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cadastro - Hole One!</title>
    <link rel="stylesheet" href="cad.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.12/jquery.mask.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.12/jquery.mask.min.js"></script>
    <script>
      //mascara cpf
      $(document).ready(function () {
        $("#CPF").mask("999.999.999-99");
      });
    </script>
  </head>

  <body>
    <div class="container">
      <div class="left-container">
        <div class="left-section">
          <img src="./img/hole.jpeg" alt="Logo Hole One" />
        </div>
      </div>
      <div class="right-container">
        <div class="right-section">
          <h2>Cadastre-se</h2>
          <form onsubmit="return checkForm(this);">
            <label for="nome">Nome Completo</label>
            <input
              type="text"
              id="nome"
              name="nome"
              required
              min="3"
              title="Nome Completo. Exemplo: Patrick Gomes"
              placeholder="Ex: Patrick Gomes"
              name="nome"
              pattern="([A-ZÀ-Ú]{1})([a-zà-ú]{2,})(([\s]{1}[A-ZÀ-Ú]{1})([a-zà-ú]{1,}))+"
              size="40"
            />

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required />

            <div class="small-input">
              <div>
                <label for="CPF">CPF</label>
                <input
                  type="text"
                  id="CPF"
                  name="CPF"
                  required
                  placeholder="Ex: XXX.XXX.XXX-XX"
                  pattern="\d{3}\.\d{3}\.\d{3}-\d{2}$"
                  title="Digite o CPF no seguinte formato: XXX.XXX.XXX-XX"
                  size="40"
                />
              </div>
              <div>
                <label for="celular">Celular</label>
                <input
                  type="tel"
                  id="celular"
                  name="celular"
                  placeholder="Ex: DDD 986328551"
                  required
                />
                <script type="text/javascript">
                  $("#celular").mask("(00) 00000-0000");
                </script>
              </div>
              <div>
                <label for="Nasc">Data de nasc</label>
                <input
                  type="date"
                  id="Nasc"
                  name="Nasc"
                  required
                  placeholder="Data até o dia de hoje"
                  title="Digite uma data até o dia de hoje"
                  onfocus="setData()"
                />
              </div>
            </div>

            <label for="senha">Senha</label>
            <input
              type="password"
              required
              id="pwd1"
              pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}"
              name="pwd1"
              onchange="form.pwd2.pattern = RegExp.escape(this.value);"
              title="Use Letras maiúsculas, minusculas e números!"
              size="40"
            />

            <label for="confirmar-senha">Confirmar Senha</label>
            <input type="password" required id="pwd2" name="pwd2" size="40" />

            <a href="#">Já possui cadastro?</a>

            <button type="submit">Cadastrar</button>
          </form>
        </div>
      </div>
    </div>

    <script>
      function setData() {
        var hoje = new Date();
        var dia = hoje.getDate();
        var mes = hoje.getMonth() + 1;
        var ano = hoje.getFullYear();

        if (dia < 10) {
          dia = "0" + dia;
        }
        if (mes < 10) {
          mes = "0" + mes;
        }

        hoje = ano + "-" + mes + "-" + dia;
        document.getElementById("Nasc").setAttribute("max", hoje);
      }
      function checkForm(form) {
        var strData = form.Nasc.value.replace(/[^0-9]/g, "/");
        var partesData = strData.split("/");
        var data = new Date(partesData[0], partesData[1] - 1, partesData[2]);
        if (data > new Date()) {
          alert("Data de Nascimento Inválida!");
          form.Nasc.focus();
          return false;
        }

        if (form.CPF.value != "") {
          var numero = form.CPF.value.replace(/[^0-9]/g, "");
          var i, soma, dig, resto, dv1, dv2;
          dv1 = parseInt(numero.substring(9, 10));
          dv2 = parseInt(numero.substring(10, 11));
          soma = 0;
          i = 0;
          for (i = 0; i < numero.length - 2; i++) {
            soma = soma + parseInt(numero.substring(i, i + 1)) * (10 - i);
          }
          resto = soma % 11;
          if (resto == 0 || resto == 1) dig = 0;
          else dig = 11 - resto;
          if (dig == dv1) {
            soma = 0;
            for (i = 0; i < numero.length - 1; i++) {
              soma = soma + parseInt(numero.substring(i, i + 1)) * (11 - i);
            }
            resto = soma % 11;
            if (resto == 0 || resto == 1) dig = 0;
            else dig = 11 - resto;
            if (dig != dv2) {
              alert("CPF Inválido!");
              form.CPF.focus();
              return false;
            }
          } else {
            alert("CPF Inválido!");
            form.CPF.focus();
            return false;
          }
          if (
            numero == "11111111111" ||
            numero == "22222222222" ||
            numero == "33333333333" ||
            numero == "44444444444" ||
            numero == "55555555555" ||
            numero == "66666666666" ||
            numero == "77777777777" ||
            numero == "88888888888" ||
            numero == "99999999999" ||
            numero == "00000000000"
          ) {
            alert("CPF Inválido\nEntre em contato com a Receita Federal!");
            return false;
          }
        }

        if (form.pwd1.value != form.pwd2.value) {
          alert("Senhas não conferem!\nVerifique as senhas e tente novamente!");
          form.pwd1.focus();
          return false;
        }
        return true;
      }
    </script>
  </body>
<?php

IF (isset($_POST["Cadastrar"])){ //verifica se o botão esta clicado
    $conexao = require("conexao.php"); //criando a conexão com o banco de dados localizado no servidor (localhost) com o usuario Root, e sua senha,            identificador do banco de dados
    $nome=$_POST["nome"]; //transformar o conteúdo html em um conteúdo php
    $email=$_POST["email"]; //transformar o conteúdo html em um conteúdo php
    $cpf=$_POST["cpf"]; //transformar o conteúdo html em um conteúdo php
    $celular=$_POST["celular"]; //transformar o conteúdo html em um conteúdo php
    $dtnasc=$_POST["dtnasc"]; //transformar o conteúdo html em um conteúdo php
    $senha=$_POST["senha"]; //transformar o conteúdo html em um conteúdo php
    if ($senha === $confirmarsenha) {
        echo $result= mysqli_query($conexao,$sql,$query);
        echo $conexao("INSERT INTO Cadastrar (nome, email, cpf, celular, dtnasc, senha)");
    };//cria uma variavel php para guardar o resultado da execuçao da query caso a senha coincida
    if ($resultado)//cria uma resposta para a alteração
     {echo "Cadastro realizado";}//caso o valor tenha sido cadastrado ele exibe essa mensagem
     else {echo "Cadastro não realizado";}//caso o dado não tenha sido encontrado ele exibe essa mensagem
       
}
?>