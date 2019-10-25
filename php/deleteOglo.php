<?php
    session_start();
    
    if (!isset($_POST['woj'])){
        header('Location ../konto.php');
        exit();
    }

     require_once "connect.php";

    $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

    if($polaczenie->connect_errno!=0){
        echo "Error".$polaczenie->connect_errno;
    }
    else{
        $rezultat = @$polaczenie->query(
            sprintf("DELETE FROM oferty WHERE woj='%s' AND pow='%s' AND town='%s' AND kom='%s' AND data='%s' AND idUser='%s'",
            $_POST['woj'],
            $_POST['pow'],
            $_POST['town'],
            $_POST['kom'],
            $_POST['data'],
            $_SESSION['id']
            ));
    }
    header('Location: ../konto.php');
    $polaczenie->close();

?>