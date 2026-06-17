<html>
  <head>
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
          width: 400px;
          padding: 40px;
          margin: auto;
          background: linear-gradient(to right,rgb(110,100,150), rgb(0,00,50));
        }
        .caixa{
          padding-top: 15px;
          padding-bottom: 15px;   
        }
        input{
          border-radius:20px;
          width: 100%;
          height:25px;
        }
        h1{
          text-align: center;
        }
        .botao{
          width: 100%;
          color: white;
          background: purple;
          margin:10px;
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
    <div id="principal">
      <form action="inserir.php" method="POST">
        <div>
          <h1>Cadastrar Usuário</h1>
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
          <input class="botao" type="submit" value="Cadastrar">
        </div>
        <div>
          <input class="botao" type="reset" value="Limpar">
        </div>
        </form>
        <div>
  </body>
</html>