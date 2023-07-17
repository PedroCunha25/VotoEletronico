<?php
session_start();

$_SESSION;

include("conectar.php");
include("functions.php");

$user_data = check_login($con);

    if ($user_data['administrador'] == 1){
        $query = "SELECT * FROM Evento"; // don't need a ; like  in SQL
        $result = mysqli_query($con,$query);
    }else{
        echo "Não tem permissões para aceder a esta zona!";
        redirect('index.php');
    }


?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->


<!DOCTYPE html>
<html lang = "pt-pt">
    <head>
        <title>Listar eventos</title>
     
   
	      <!--Bootsrap 4 CDN-->
	  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<!--Custom styles-->
	<link rel="stylesheet" type="text/css" href="styles.css">



      </head>
    <body>
    <body style = "background-color: d9edf7">
    <div id="login"><br>
        <h1 class="text-center text-black pt-5">ATWVotos</h1><br><br>
        <div class="container">
            <img src="logo_final.png" class="mx-auto d-block" alt="Logo_final" width="220" height="220"><br><br>
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
  <tr>
  
  <thead>
    <tr>
    <table class="table table bordered table-striped table-light">
      
    <th scope="col">Número do Evento</th>
      <th scope="col">Título</th>
      <th scope="col">Data_inicio</th>
      <th scope="col">Data_fim</th>
      <th scope="col">Editar</th>
      <th scope="col">Eliminar</th>
    </tr>
    
  

<?php

while($data = mysqli_fetch_array($result))
{
?>
<br><br>
  <tr>
    <td><?php echo $data['evento_id']; ?></td>
    <td><?php echo $data['titulo']; ?></td>
    <td><?php echo $data['data_inicio']; ?></td>
    <td><?php echo $data['data_fim']; ?></td>       
    <td><a href="editarEvento.php?id=<?php echo $data['evento_id']; ?>">Editar</a></td>
    <td><a href="eliminarEvento.php?id=<?php echo $data['evento_id']; ?>">Eliminar</a></td>
  </tr>	
<?php
}
?>
</table>
<br><br><br><br><br><br>
    <a href="criarEvento.php" class="text-body" >Criar evento</a>
    &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;

    <a href="index.php" class="text-body">Voltar à página inicial</a>
     &nbsp;&nbsp;&nbsp;&nbsp;      
  </div>
        
    </body>
   
</html>