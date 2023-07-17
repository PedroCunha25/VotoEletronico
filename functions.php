<?php

function check_login($con)
{
    if(isset($_SESSION['id_eleitor']))
    {
        $id = $_SESSION['id_eleitor'];
        $query = "select * from Eleitor where id_eleitor = '$id' limit 1";

        $result = mysqli_query($con, $query);
        if ($result && mysqli_num_rows($result) > 0 )
        {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }

    // Redirecionar para o login caso o código não funcione

    header ("Location: login.php");
    die;
}


?>