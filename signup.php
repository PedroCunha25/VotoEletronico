<?php
session_start();

$_SESSION;

include("conectar.php");
include("functions.php");

$user_data = check_login($con);

    if ($user_data['administrador'] == 1){
        if($_SERVER['REQUEST_METHOD'] == "POST")
        {
            // Se alguma coisa foi escrito ou não
            $nome= $_POST['Nome'];
            $email= $_POST['Email'];
            $tipo= $_POST['Tipo'];
            $numero= $_POST['Numero'];
            $pass_user= $_POST['Password'];
            
    
            //Verificação
            
            if(!empty($nome) && !empty($pass_user) && !empty($email) && !is_numeric($nome)){
                //Guardar na base de dados
                $querry = "INSERT INTO Eleitor (nome, email, password, administrador, tipo_id, nr_id) values ('$nome', '$email', '$pass_user', 0, '$tipo', '$numero')";
                $sqlVerify = "SELECT * FROM Eleitor WHERE email = '$email' OR tipo_id = '$tipo' AND nr_id = '$numero'";
                
                $result = mysqli_query($con, $sqlVerify);
                if ($result && mysqli_num_rows($result) > 0 ){
                    echo "já existe uma conta com esse email ou numero de identificação";
                }else{
                    
                    if ($con->query($querry) === TRUE) {
                        echo "Conta criada com sucesso";
                      } else {
                        echo "Error: " . $querry . "<br>" . $con->error;
                      }
                }
                  $con->close();
                header("Location: index.php");
    
            }else
            {
                echo "Por favor insira informação válida!";
            }
    
        }
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
	<title>Signup </title>
 
   
	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<!--Custom styles-->
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body style = "background-color: d9edf7">
    <div id="Signup">
        <h1 class="text-center text-black pt-5">Registo</h1><br><br>
        <div class="container">
            <img src="logo_final.png" class="float-right" alt="Logo_final" width="300" height="300"><br><br>
            <div id="signup-row" class="row justify-content-center align-items-center">
                <div id="signup-column" class="col-md-6">
                    <div id="signup-box" class="col-md-12">
                        <form id="signup-form" class="form" action="" method="post">
                            <div class="form-group">
                                <label for="Nome" class="text-black">Nome de utilizador:</label>
                                <input type="text" name="Nome" id="text" class="form-control" placeholder="Nome de utilizador" required name ="nome" ><br>
                            </div>
                            <div class="form-group">
                                <label for="email" class="text-black">Email do utilizador:</label>
                                <input type="email" name="Email" id="text" class="form-control" placeholder="Email do utilizador" required name = "email" ><br>
                            </div>
                                


                             <div class="form-group">
                                <label for="Password" class="text-black">Password:</label>
                                <input type="password" name="Password" id="password" class="form-control" placeholder="Password" required name = "password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Tem de conter pelo menos um número, uma letra maiuscula, uma letra minuscula. 8 ou mais caracteres" required>
                                

                                </style>
                                <div id="message">
                                <h3>A password tem de conter pelo menos :</h3>
                                <p id="letter" class="invalid"> <b>Uma Letra Maiuscula</b>
                                <p id="capital" class="invalid"><b>Uma Letra Minuscula</b>
                                <p id="number" class="invalid"><b>Um número</b>
                                <p id="length" class="invalid"><b>Minimo 8 caracteres</b>
                                

                                
<style type="text/css">
                                
input {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
}

/* Style the submit button */
input[type=submit] {
  background-color: #d9edf7;
  color: white;
}

/* Style the container for inputs */
.container {
  background-color: #d9edf7;
  padding: 20px;
}

/* The message box is shown when the user clicks on the password field */
#message {
  display:none;
  background: #d9edf7;
  color: #000;
  position: relative;
  padding: 20px;
  margin-top: 10px;
}

#message p {
  padding: 10px 35px;
  font-size: 18px;
}

/* Add a green text color and a checkmark when the requirements are right */
.valid {
  color: green;
}

.valid:before {
  position: relative;
  left: -35px;
  
}

/* Add a red text color and an "x" icon when the requirements are wrong */
.invalid {
  color: red;
}

.invalid:before {
  position: relative;
  left: -35px;
  
}
</style>
                                
    
<script>
var myInput = document.getElementById("password");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");

// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
  document.getElementById("message").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
  document.getElementById("message").style.display = "none";
}

// When the user starts to type something inside the password field
myInput.onkeyup = function() {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
}

  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }

  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
  
}
</script>
                       
</div>                                                                                                                                                                          
                                
                        
    </div>
            <label for="Password" class="text-black">Confirme a Password:</label>
                <input type="password" name="Password" id="confirm_password" class="form-control" placeholder="Repita a password" required><br> 
<script>

         var password = document.getElementById("password")
         , confirm_password = document.getElementById("confirm_password");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("As passwords nao são iguais, tente outra vez");
  } else {
    confirm_password.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
                            </script>
                           
                            <!-- Botao -->
                            <div class="form-group">
                                <label for="Nome" class="text-black">Tipo de Documento:</label>
                                <select class="form-group" name="Tipo" id="Tipo" >
                                    <option value="cc">Cartão de cidadão</option>
                                    <option value="bi">Bilhete de identidade</option>
                                <input type="number" name="Numero" id="Numero" class="form-control" placeholder="Numero de Identificação" required><br>
                            </div>
                            <button type="submit" class="btn btn-dark btn-md"> Registar</button><br><br>
                            <a href="index.php" class="text-body">Voltar à página principal</a> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>


