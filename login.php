<?php
session_start();

    include("conectar.php");
    include("functions.php");

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        // Se alguma coisa foi escrito ou não
        $nome= $_POST['Nome'];
        $pass_user= $_POST['Password'];

        //Verificação

        if(!empty($nome) && !empty($pass_user) && !is_numeric($nome))
        {
            //Ler da base de dados
            $querry = "select * from Eleitor where nome = '$nome' limit 1";
            $result = mysqli_query($con, $querry);

            if($result)
            {
                if ($result && mysqli_num_rows($result) > 0 )
                {
                    $user_data = mysqli_fetch_assoc($result);
                    if($user_data['password'] === $pass_user)
                    {
                        $_SESSION['id_eleitor'] = $user_data['id_eleitor'];
                        header ("Location: index.php");
                    }
                }
            }
        }else
        {
            echo "Palavra passe ou utilizador errado!"; // alinhar esta mensagem //
        }
    }   
 
?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html lang = "pt-pt">
<head>
	<title>Login </title>
  
   
	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<!--Custom styles-->
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body style = "background-color: d9edf7">
    <div id="login"><br>
        <h1 class="text-center text-black pt-5">ATWVotos</h1><br><br>
        <div class="container">
            <img src="logo_final.png" class="mx-auto d-block" alt="Logo_final" width="220" height="220"><br><br>
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="" method="post">
                            <h3 class="text-center text-black">Login</h3>
                            <div class="form-group">
                                <label for="Nome" class="text-black">Nome de utilizador:</label><br>
                                <input type="text" name="Nome" id="text" class="form-control"  placeholder="Nome de utilizador" required> <br />
                            </div>
                            <div class="form-group">
                                <label for="Password" class="text-black">Password:</label><br>
                                <input type="password" name="Password" id="text" class="form-control" placeholder="Password" required > <br />
                            </div>
                            <div class="form-group">
                                <label for="remember-me" class="text-black"><span>Remember me</span> <span><input id="remember-me" name="remember-me" type="checkbox"></span></label><br>
                                <input type="submit" name="submit" class="btn btn-dark btn-md" value="Login">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

