<?php
session_start();

$_SESSION;

include("conectar.php");
include("functions.php");

$user_data = check_login($con);
        $id_user = $user_data['id_eleitor'];
        $id = $_GET['id']; // get id through query string
        $data_atual = date('Y-m-d');
        $checkVote = "SELECT * FROM Voto where evento_id = '$id' and eleitor_id = '$id_user'";
        $contagem = "SELECT opcao_id, count(*) FROM Voto group by opcao_id";
        $sql = "SELECT * FROM Opcao where evento_id = '$id'";
        $sql2 = "SELECT * FROM Evento where evento_id = '$id'";
  
        $checkResult = mysqli_query($con, $checkVote);
        $checkRow = mysqli_fetch_array($checkResult);
        $result = mysqli_query($con, $sql);
        $result2 = mysqli_query($con, $sql2);
        $row2 = mysqli_fetch_array($result2);
        
        if ($row2['data_fim'] <= $data_atual){
            
            $contagemResult = mysqli_query($con, $contagem);
            //$contagemRow = mysqli_fetch_array($contagemResult);
            //var_dump($contagemRow); // Testagem/alternativa //
            
            
            ?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<!DOCTYPE html>
<html lang = "pt-pt">
<head>
	
   
	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<!--Custom styles-->
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body style = "background-color: d9edf7">
<h1>As votações encerraram</h1>
<thead>
    <tr>
    <table class="table table bordered table-striped table-light">    
    <th scope="col">Id Opcao</th>
    <th scope="col">Contagem dos Votos</th>
    </tr>
<?php 
while($contagemRow = mysqli_fetch_array($contagemResult)){
?>
<br><br>
<tr>
    <td><?php echo $contagemRow ['opcao_id']; ?></td>
    <td><?php echo $contagemRow ['count(*)']; ?></td>
<?php 
}
?>
<div class="text-center">
<img src="logo_final.png" class="rounded" alt="Logo_final" width="220" height="220"><br><br>
<?php
}else {
?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<!DOCTYPE html>
<html lang = "pt-pt">
<head>
	
   
	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<!--Custom styles-->
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body style = "background-color: d9edf7">
    
    
    
    
    <h1><?php echo $row2['titulo'];?></h1>
    <h2><?php echo $row2['descricao'];?></h2>    
    <p><?php echo $row2['instrucoes'];?></p>
<form action="votarInsert.php" method="POST" enctype=”multipart/form-data”>
<?php
        if(mysqli_num_rows($result) > 0 && $checkRow < 1){
            while($row = mysqli_fetch_array($result)){
?>
<div>
<p><input type="radio" name="opcao" value="<?php echo $row['opcao_id']?>" required >
  <label for="radio"><?php echo $row['nome'];?></label>
</div>   
<?php } ?>
<div>
<input type="radio" name="publico" value="1">
  <label for="publico">Voto público?</label><br>
</div>
<input type="hidden" name="id_evento" value="<?php echo $id?>">
<div class="form-group">
<input type="submit" name="submit" class="btn btn-dark btn-md" value="Votar">
</div>
<div class="text-center">
<img src="logo_final.png" class="rounded float-left" alt="Logo_final" width="220" height="220"><br><br>
</div>
</form>
<?php        
    }else{
        echo "Não existem opções ou já efetuou um voto neste evento, caso queira confirmar a sua opção verifique o seu email!";
    }
?>
</html>
<?php
}
?>