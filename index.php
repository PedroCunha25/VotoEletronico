<?php
session_start();

    $_SESSION;

    include("conectar.php");
    include("functions.php");

    $user_data = check_login($con);

    $user_data = check_login($con);
        $query = "SELECT * FROM Evento"; // don't need a ; like in SQL
        $result = mysqli_query($con,$query);
?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->




<!DOCTYPE html>
<html lang = "pt-pt"> 
    <head>
        <title>Pagina principal</title>
    </head>
    <body>
    <body style = "background-color: d9edf7"> 
    <h1 class="text-center text-black pt-5">ATWVotos</h1><br><br>
        <div class="container">
            <img src="logo_final.png" class="mx-auto d-block" alt="Logo_final" width="220" height="220">
            <div id="logout-row" class="row justify-content-center align-items-center">
                <div id="logout-column" class="col-md-12">
                    <div id="logout-box" class="col-md-6">
                        <form id="logout-form" class="form" action="" method="post">
 
 
 <?php if ($user_data['administrador'] == 1){?>
        <h1>Página principal (Permite qualquer mensagem para o administrador)</h1>
        <br/>
        
        <h2>Bem-vindo administrador <?php echo $user_data['nome'];?></h2><br/><br/>

        <a href="listaEventos.php">
        <div class="row">
		        <div class="col">
            <button type="button" class="btn btn-dark">Lista de Eventos</button><br/>
		      </div>
        </a>
        
        <!------ Espaçamento entre butões ---------->
        &nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;
        
        <a href="signup.php">
        <div class="row">
		        <div class="col">
            <button type="button" class="btn btn-dark">Criar Utilizador</button><br/>
		      </div>
        </a>
        
        &nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;
        
        <a href="logout.php">
        <div class="row">
		        <div class="col">
            <button type="button" class="btn btn-dark">Logout</button><br/>
            
          </div>
        </a>
    <?php }else{ ?>
    <h1>Página principal</h1><br/><br/>
        <style type="text/css">
        #text{
        height: 25px;
        border-radius: 30px;
        padding: 10px;
        border: solid thin #aaa;
        width: 100%;
        }
        #button{
        padding: 10px;
        width: 100px;
        color: black;
        background-color: white;
        border: none;
        }
        #box{
 
        background-color: grey;
        margin: auto;
        width: 500px;
        padding: 200px;
        }
        </style>
        <div id = "boxw">
        <table border="2">
  <table class="table table bordered table-striped table-light">
  <thead>
    <tr>
      <th scope="col">Número do evento</th>
      <th scope="col">Título</th>
      <th scope="col">Data inicio</th>
      <th scope="col">Data fim</th>
      <th scope="col">Votar</th>
    </tr>
  </thead>
<?php
while($data = mysqli_fetch_array($result))
{
?>
  <tr>
    <td><?php echo $data['evento_id']; ?></td>
    <td><?php echo $data['titulo']; ?></td>
    <td><?php echo $data['data_inicio']; ?></td>   
    <td><?php echo $data['data_fim']; ?></td>    
    <td><a href="votarEvento.php?id=<?php echo $data['evento_id']; ?>">Votar</a></td>
  </tr>	
<?php
}
?>
</table><br/><br/>
<a href="logout.php">
        <div class="row">
		        <div class="col">
            <button type="button" class="btn btn-dark">Logout</button><br/>
            
          </div>
        </a>
        <?php
}
?>
    </body>
   
</html>