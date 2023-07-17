<?php
session_start();

$_SESSION;

include("conectar.php");
include("functions.php");

$user_data = check_login($con);
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $id_user = $user_data['id_eleitor'];
    $opcao= $_POST['opcao'];
    $publico= $_POST['publico'];
    $id_evento= $_POST['id_evento'];
    $data_atual = date('Y-m-d');
    if ($publico == 1){
        $querry = "INSERT INTO Voto (data_voto, eleitor_id, evento_id, opcao_id, anonimo) values ('$data_atual', '$id_user', '$id_evento', '$opcao', 0)";
    }else{
        $querry = "INSERT INTO Voto (data_voto, eleitor_id, evento_id, opcao_id, anonimo) values ('$data_atual', '$id_user' , '$id_evento', '$opcao', 1)";
    }

    if ($con->query($querry) === TRUE) {
        echo "Voto submetido e confirmação enviada";
        $to = $user_data['email'];
        $subject = "Confirmação de voto";
        
        $message = "<b>O seu voto foi devidamente submetido na data " . $data_atual . ".</b>";
        $message .= "<h1>Obrigado pela preferência.</h1>";
        
        $header = "From:sequirei.costa11@gmail.com \r\n";
        
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html\r\n";
        
        $retval = mail ($to,$subject,$message,$header);
        
        if( $retval == true ) {
           echo "Message sent successfully...";
        }else {
           echo "Message could not be sent...";
        }
        header("Location: index.php");
      } else {
        echo "Error: " . $querry . "<br>" . $con->error;
      }

}
?>
