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
            $titulo= $_POST['titulo'];
            $descricao= $_POST['descricao'];
            $instrucoes= $_POST['instrucoes'];
            $observacoes= $_POST['observacoes'];
            $data_inicio= $_POST['data_inicio'];
            $data_fim= $_POST['data_fim'];
            $opcoes = array($_POST['opc1'], $_POST['opc2'], $_POST['opc3'],$_POST['opc4']);
    
            //Verificação
            
            if(!empty($titulo) && !empty($descricao) && !empty($instrucoes) && !empty($observacoes) && !empty($data_inicio) && !empty($data_fim)) {
                //Guardar na base de dados
                $query = "INSERT INTO Evento (titulo, descricao, instrucoes, observacoes, data_inicio, data_fim) values ('$titulo', '$descricao', '$instrucoes', '$observacoes', '$data_inicio', '$data_fim')";
                $sqlVerify = "SELECT * FROM Evento WHERE titulo = '$titulo' ";

                
                
                $result = mysqli_query($con, $sqlVerify);
                if ($result && mysqli_num_rows($result) > 0 ){
                    echo "já existe um evento com esse titulo!";
                }else{
                    if ($con->query($query) === TRUE) {
                        $query_id = "SELECT * FROM Evento where titulo = '$titulo' ";
                        $result = mysqli_query($con, $query_id);
                        if ($result && mysqli_num_rows($result) > 0 ){
                            $event_data = mysqli_fetch_assoc($result);
                            $event_id = $event_data['evento_id'];
                            for ($i = 0; $i < count($opcoes); $i++) {
                                $query3 = "INSERT INTO Opcao (nome, evento_id) values ('$opcoes[$i]', '$event_id' )";
                                $con->query($query3);
                            }
                            
                        }
                        echo "Evento criado com sucesso";
                      } else {
                        echo "Error: " . $querry . "<br>" . $con->error;
                      }
                }
                  $con->close();
                  
                header ("Location: listaEventos.php");
    
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
        
   
   
	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<!--Custom styles-->
	<link rel="stylesheet" type="text/css" href="styles.css">
    </head>
    <body>
        <style type="text/css">
        </style>
        <div id = "boxw">
        <body style = "background-color: d9edf7">
            <form method="post" action="criarEvento.php">
                <div style="font-size: 40px;MARGIN: 20px;color: black;">Criar Evento</div>
            
                <form role="form">
	            <div class="form-group">
                    
                <form>
                    <div class="form-group">  
                            <label for= titulo >Titulo</label>                          
                            <input id="text" name="titulo" type="text" placeholder="Título" class="form-control input-md" required="">
                    </div>
                        <div class="form-group">  
                            <label for=descricao>Descrição</label>                          
                            <input id="text" name="descricao" type="text" placeholder="Descrição" class="form-control input-md" required="">
                        </div>
                        <div class="form-group">   
                            <label for=instrucoes>Instruções</label>                    
                            <input id = "text" name="instrucoes" type="text" class="form-control" id="formGroupExampleInput" placeholder="Instruções" required ="">
                        </div>
                        <div class="form-group"> 
                            <label for=observacoes>Observações</label>                           
                            <input id ="text" name="observacoes" type="text" class="form-control" id="formGroupExampleInput2" placeholder="Observações" required ="">
                        </div>
                        <div class="form-group">  
                            <label for=data_inicio>Data de Inicio</label>                          
                            <input id ="text" name="data_inicio" type="date"  max="3000-12-31"  min="1000-01-01" class="form-control" placeholder="Data início" required>
                        </div>
                        <div class="form-group">  
                            <label for=data_fim>Data de Fim</label>
                            <input id = text name="data_fim" type="date"  min="1000-01-01"max="3000-12-31" class="form-control" placeholder="Data Fim" required>  
                        </div>
                        <div class="form-group">  
                            <label for=opc1>Opção 1</label>
                            <input id =text name="opc1" type="text" class="form-control" id="exampleInputText1" aria-describedby="textHelp" placeholder="Opção 1" required>
                        </div>
                        <div class="form-group">  
                            <label for=opc2>Opção 2</label>
                            <input id =text name="opc2" type="text" class="form-control" id="exampleInputText1" aria-describedby="textHelp" placeholder="Opção 2" required>
                        </div>
                        <div class="form-group">  
                            <label for=opc3>Opção 3</label>
                            <input id =text name="opc3" type="text" class="form-control" id="exampleInputText1" aria-describedby="textHelp" placeholder="Opção 3" required>
                        </div>
                        <div class="form-group">  
                            <label for=opc4>Opçao4</label>
                            <input id =text name="opc4" type="text" class="form-control" id="exampleInputText1" aria-describedby="textHelp" placeholder="Opção 4"required>
    
                        </div>
                        <div class="form-group">  
                            <label for=Registar></label>
                            <button id="registar" name="registar" class="btn btn-dark ">Registar</button>
    
                        </div>
                    
                </form>
        
                <a href="index.php" class="text-body">Voltar à página principal</a>
            </form>
        </div>
        
    </body>
   
</html>