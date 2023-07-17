<?php
session_start();

$_SESSION;

include("conectar.php");
include("functions.php");

$user_data = check_login($con);

    if ($user_data['administrador'] == 1){
        $i = 0;
        $evento_id = $_POST['id_evento'];
        $titulo= $_POST['titulo'];
        $descricao= $_POST['descricao'];
        $instrucoes= $_POST['instrucoes'];
        $observacoes= $_POST['observacoes'];
        $data_inicio= $_POST['data_inicio'];
        $data_fim= $_POST['data_fim'];
        $opc1 = $_POST['opc1'];
        $opc2 = $_POST['opc2'];
        $opc3 = $_POST['opc3'];
        $opc4 = $_POST['opc4'];

        echo "\id" . $evento_id;
        /*echo "|t" . $titulo;
        echo "d" . $descricao;
        echo "i" . $instrucoes;
        echo "o" . $observacoes;
        echo "da_i" . $data_inicio;
        echo "data_f" . $data_fim;
        echo "opc1" . $opc1;
        echo "2" . $opc2;
        echo "3" . $opc3;
        echo "4" . $opc4;*/

        $query = "SELECT * FROM Evento WHERE evento_id = '$evento_id'"; 
        $result = mysqli_query($con,$query);
        $event_data = mysqli_fetch_assoc($result);

        //echo $id;
        $query1 = "SELECT * FROM Opcao WHERE evento_id = '$evento_id'"; 
        $result1 = mysqli_query($con,$query1);
        //$opcao_data = mysqli_fetch_array($result1);
        while($data = mysqli_fetch_assoc($result1)){
            $id_opc[$i] = $data['opcao_id'];
            $nome_opc[$i] = $data['nome'];
            $i++;
        }

        $opc_id1 = $id_opc[0];
        $opc_id2 = $id_opc[1];
        $opc_id3 = $id_opc[2];
        $opc_id4 = $id_opc[3];


        if ($event_data['titulo'] == $titulo && $event_data['descricao'] == $descricao && $event_data['instrucoes'] == $instrucoes && $event_data['observacoes'] == $observacoes && $event_data['data_inicio'] == $data_inicio && $event_data['data_fim'] == $data_fim && $nome_opc[0] == $opc1 && $nome_opc[1] == $opc2 && $nome_opc[2] == $opc3 && $nome_opc[3] == $opc4){
            echo "Não foram efetuadas alterações";
        }else{
            $sql1 = "UPDATE Evento SET titulo ='$titulo', descricao = '$descricao', instrucoes = '$instrucoes', observacoes = '$observacoes', data_inicio = '$data_inicio', data_fim = '$data_fim' WHERE evento_id='$evento_id'";
            $sql2 = "UPDATE Opcao SET nome='$opc1' WHERE evento_id='$evento_id' and opcao_id = '$opc_id1'";
            $sql3 = "UPDATE Opcao SET nome='$opc2' WHERE evento_id='$evento_id' and opcao_id = '$opc_id2'";
            $sql4 = "UPDATE Opcao SET nome='$opc3' WHERE evento_id='$evento_id' and opcao_id = '$opc_id3'";
            $sql5 = "UPDATE Opcao SET nome='$opc4' WHERE evento_id='$evento_id' and opcao_id = '$opc_id4'";
            if ($con->query($sql1) === TRUE && $con->query($sql2) === TRUE && $con->query($sql3) === TRUE && $con->query($sql4) === TRUE && $con->query($sql5) === TRUE ) {
                echo "editado com sucesso";   
                header ("Location: listaEventos.php");
            } else {
                echo "Error updating record: " . $con->error;
              }


        }


    }else{
        echo "Não tem permissões para aceder a esta zona!";
        redirect('index.php');
    }


?>