<?php

    session_start();

    
    
    if (!isset($_POST['haslo1']) && (!isset($_POST['nNazwa'])) && (!isset($_POST['dLogin'])) && (!isset($_POST['addWoj']))){
        header('Location ../konto');
        exit();
    }
    require_once "connect.php";

    $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

    if($polaczenie->connect_errno!=0){
        echo "Error".$polaczenie->connect_errno;
    }
    else{
        if( isset($_POST['haslo1'])){
            
            $hasloNowe = $_POST["haslo1"];
            $hasloStare = $_POST["haslo3"];
            
            if($rezultat = @$polaczenie->query(
            sprintf("SELECT haslo FROM user WHERE id='%s'",
            $_SESSION['id']
            ))){
                $wiersz = $rezultat->fetch_assoc();
                if(password_verify($hasloStare, $wiersz['haslo'])){
                    $haslo_hash = password_hash($hasloNowe, PASSWORD_DEFAULT);
                    @$polaczenie->query(
                        sprintf("UPDATE user SET haslo='%s' WHERE id='%s'",
                        $haslo_hash,
                        $_SESSION['id']
                        ));
                }
                else{
                    $_SESSION['changePassBlad'] = "Niepoprawne hasło."; 
                }
            }
        }
        if( isset($_POST['nNazwa'])){
            
            $nowaNazwa = $_POST["nNazwa"];
            $haslo = $_POST["nHaslo"];
            
            if($rezultat = @$polaczenie->query(
            sprintf("SELECT haslo FROM user WHERE id='%s'",
            $_SESSION['id']
            ))){
                $wiersz = $rezultat->fetch_assoc();
                if(password_verify($haslo, $wiersz['haslo'])){
                    
                    $rezultat = @$polaczenie->query(
                        sprintf("SELECT nazwa FROM user WHERE nazwa='%s'",
                        $nowaNazwa
                        ));
                        $czyJest = $rezultat->num_rows;
                     
                    if($czyJest == 0){
                        @$polaczenie->query(
                        sprintf("UPDATE user SET nazwa='%s' WHERE id='%s'",
                        $nowaNazwa,
                        $_SESSION['id']
                        ));
                        $_SESSION['user'] = $nowaNazwa;
                    }
                    else{
                        $_SESSION['changeNameBlad'] = "Nazwa jest juz używana."; 
                    }
                    
                    
                }
                else{
                    $_SESSION['changeNameBlad'] = "Niepoprawne hasło."; 
                }
            }
        }
        if( isset($_POST['dLogin'])){
            
            $login = $_POST["dLogin"];
            $haslo = $_POST["dHaslo"];
            
            if($rezultat = @$polaczenie->query(
            sprintf("SELECT haslo, nick FROM user WHERE id='%s'",
            $_SESSION['id']
            ))){
                $wiersz = $rezultat->fetch_assoc();
                if(password_verify($haslo, $wiersz['haslo']) && $wiersz['nick'] == $login){
                    
                    @$polaczenie->query(
                            sprintf("DELETE FROM user WHERE id='%s'",
                            $_SESSION['id']
                            ));
                    @$polaczenie->query(
                            sprintf("DELETE FROM oferty WHERE idUser='%s'",
                            $_SESSION['id']
                            ));
                    
                    $polaczenie->close();
                     session_unset();
                    $_SESSION['afterDeleteAcc'] = "Obyś kiedyś wrócił!";
                    header('Location: ../logowanie');
                    exit();
                }
                else{
                    $_SESSION['deleteBlad'] = "Niepoprawne dane."; 
                }
            }
        }
        
        if( isset($_POST['addWoj'])){
            $woj = $_POST["addWoj"];
            $pow = $_POST["addPow"];
            $gmi = $_POST["addGmi"];
            $town = $_POST["addTown"];
            $kom = $_POST["addArea"];
            
            $rezultat = @$polaczenie->query(
            sprintf("INSERT INTO oferty (woj, pow, gmi, town, kom, idUser, data) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s')",
                    $woj,
                    $pow, 
                    $gmi,
                    $town,
                    $kom,
                    $_SESSION['id'],
                    date("Y-m-d H:i:s")
                    ) );
        }
                header('Location: ../konto');

        $polaczenie->close();
    };

    
?>