<html>
  <head>
     <title>Login</title>
     <style>
        body{
          color:white;
        }
        p{
          color: green;
        }
        div{
          /* border: 1px solid; */
          border-radius: 20px;
        }
        #principal{
          width: 200px;
          padding: 20px;
          margin: auto;
          background: linear-gradient(to right,rgb(0,100,50), rgb(0,100,250), rgb(100,0,100));
        }
        .caixa{
          padding-top: 15px;
          padding-bottom: 15px;   
        }
        input{
          border-radius:20px;
          width: 100%;
        }
        h1{
          text-align: center;
        }
        .botao{
          width: 100%;
          color: white;
          background: dodgerblue;
        }
        .criar{
          border-radius:20px;
          background-color: white;
          color: black;
        }
        #dados{
          color: red;
        }
     </style>
  </head>
  <body>
     <p><?php echo date("d/m/Y");   ?></p>
     <div id="principal">
      <form action="login.php" method="POST">
        <div>
          <h1>Login</h1>
        </div>
        <div class="caixa">
          <label for="usuario">Usuário:</label>
          <input type="text" name="usuario">
        </div>
        <div class="caixa">
          <label for="senha">Senha:</label>
          <input type="password" name="senha">
        </div>
        <div>
          <input class="botao" type="submit" value="Enviar">
        </div>
        </form>
        <div>
          <button class="botao criar" onclick="window.location.href='criarconta.php'">Criar nova conta</button>
        </div>
     </div>
     <div id="dados">
        <?php
          if (!empty($_POST["usuario"]) && !empty($_POST["senha"]))
          {
            $usuario = $_POST["usuario"]; 
            $senha = $_POST["senha"];
            if($usuario=="Carlos" && $senha=="123")
              header("location: site.html");
            else
              echo "Usuário e/ou senha inválido(s)!";


        ?>
                <?php
    include "conecta.php";
  $usuario = $_POST["usuario"];
  $senha = $_POST["senha"];
    $sql = "select * from usuario where nome = 'Guilherme' and senha '123';";
    $resultado = mysqli_query($conexao, $sql);


    if(mysqli_num_rows($resultado)> 0){
      header("location: site.html");
    
    }else{
      echo "Deu ruim";
    }

        
          }
        ?>
     </div> 
  </body>
</html>