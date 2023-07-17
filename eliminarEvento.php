<?php
session_start();

$_SESSION;

include("conectar.php");
include("functions.php");

$user_data = check_login($con);

    if ($user_data['administrador'] == 1){
        $id = $_GET['id']; // get id through query string
        $delOpcao = ("DELETE FROM Voto where evento_id = '$id'");
        $delVotos = ("DELETE FROM Opcao where evento_id = '$id'"); 
        $delEventos = ("DELETE FROM Evento where evento_id = '$id'"); 
        $checkOpcao = mysqli_query($con, $delOpcao);
        $checkVoto = mysqli_query($con, $delVotos);
        $checkEvento = mysqli_query($con, $delEventos);
        if ($checkEvento == TRUE && $checkOpcao == TRUE && $checkVoto == TRUE){
            echo "Eliminado com sucesso";
            header ("Location: listaEventos.php");
        }else{
            echo "Ocorreu um erro ao eliminar esse evento";
        }
    }else{
        echo "Não tem permissões para aceder a esta zona!";
        redirect('index.php');
    }


?>
