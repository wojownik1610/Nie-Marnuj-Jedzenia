<?php
 
    if(!isset($_GET['woj'])){
        header('Location ../zaloguj.php');
        exit();
    }
header('Content-type: application/json');
 
require_once('connect.php');


 $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

    if($polaczenie->connect_errno!=0){
        echo "Error".$polaczenie->connect_errno;
    }
else{

    $woj = $_GET['woj'];
    $pow = $_GET['pow'];
    $gmi = $_GET['gmi'];
    $town = $_GET['town'];
    $co = $_GET['co'];
    
    $woj = htmlentities($woj, ENT_QUOTES, "UTF-8");
    $pow = htmlentities($pow, ENT_QUOTES, "UTF-8");
    $gmi = htmlentities($gmi, ENT_QUOTES, "UTF-8");
    $town = htmlentities($town, ENT_QUOTES, "UTF-8");
    
    $czyOk = false;
    
    switch($co){
        case 0:
            if($rezultat = @$polaczenie->query(
                sprintf("SELECT * FROM oferty ORDER BY data DESC"
                ))) $czyOk = true;
                break;
        case 1:
            if($rezultat = @$polaczenie->query(
                sprintf("SELECT * FROM oferty WHERE woj='%s' ORDER BY data DESC",
                mysqli_real_escape_string($polaczenie, $woj)
                ))) $czyOk = true;
                break;
        case 2:
            if($rezultat = @$polaczenie->query(
            sprintf("SELECT * FROM oferty WHERE woj='%s' AND pow='%s' ORDER BY data DESC",
            mysqli_real_escape_string($polaczenie, $woj),
            mysqli_real_escape_string($polaczenie, $pow),
            mysqli_real_escape_string($polaczenie, $gmi),
            mysqli_real_escape_string($polaczenie, $town)
            )))$czyOk = true;
                break;
            
        case 3:
            if($rezultat = @$polaczenie->query(
            sprintf("SELECT * FROM oferty WHERE woj='%s' AND pow='%s' AND gmi='%s' ORDER BY data DESC",
            mysqli_real_escape_string($polaczenie, $woj),
            mysqli_real_escape_string($polaczenie, $pow),
            mysqli_real_escape_string($polaczenie, $gmi)
            )))$czyOk = true;
                break;
                
        case 4:
            if($rezultat = @$polaczenie->query(
            sprintf("SELECT * FROM oferty WHERE woj='%s' AND pow='%s' AND gmi='%s' AND town='%s' ORDER BY data DESC",
            mysqli_real_escape_string($polaczenie, $woj),
            mysqli_real_escape_string($polaczenie, $pow),
            mysqli_real_escape_string($polaczenie, $gmi),
            mysqli_real_escape_string($polaczenie, $town)
            )))$czyOk = true;
                break;
    }
        
        if($czyOk){
                
                
            
                $pobrane_dane = array();
            
                while ($wiersz = mysqli_fetch_row($rezultat)){
                  $pobrane_dane[] = $wiersz;
                }
                echo json_encode($pobrane_dane);
            }
    }

?>