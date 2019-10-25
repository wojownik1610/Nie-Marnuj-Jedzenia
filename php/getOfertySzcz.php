<?php
 
    if(!isset($_GET['idUser'])){
        header('Location ../oferty');
        exit();
    }
header('Content-type: application/json');
 
require_once('connect.php');


 $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

    if($polaczenie->connect_errno!=0){
        echo "Error".$polaczenie->connect_errno;
    }
else{

    $idUser = $_GET['idUser'];
    
    $idUser = htmlentities($idUser, ENT_QUOTES, "UTF-8");
    
            if($rezultat = @$polaczenie->query(
                sprintf("SELECT nazwa, mail FROM user WHERE id=%s",
                         mysqli_real_escape_string($polaczenie, $idUser)
                ))){
        
                 $pobrane_dane = array();
            
                while ($wiersz = mysqli_fetch_row($rezultat)){
                  $pobrane_dane[] = $wiersz;
                }
                echo json_encode($pobrane_dane);
            }
    }

?>