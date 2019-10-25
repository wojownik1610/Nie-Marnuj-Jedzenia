<?php

    session_start();
    
    if (!isset($_POST['login']) || (!isset($_POST['haslo']))){
        header('Location ../logowanie');
        exit();
    }

    require_once "connect.php";

    $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

    if($polaczenie->connect_errno!=0){
        echo "Error".$polaczenie->connect_errno;
    }
    else{
        $login = $_POST["login"];
        $haslo = $_POST["haslo"];
        
        $login = htmlentities($login, ENT_QUOTES, "UTF-8");
        
        if($rezultat = @$polaczenie->query(
            sprintf("SELECT * FROM user WHERE BINARY nick='%s'",
            mysqli_real_escape_string($polaczenie, $login)
            ))){
            
            $ilu_user = $rezultat->num_rows;
            if($ilu_user>0){
                $wiersz = $rezultat->fetch_assoc();
                
                if(password_verify($haslo, $wiersz['haslo'])){

                    $_SESSION['zalogowany'] = true;


                    $_SESSION['id'] = $wiersz['id'];
                    $_SESSION['user'] = $wiersz['nazwa'];

                    unset($_SESSION['blad']);
                    $rezultat->free_result();
                    header('Location: ../konto');
                }
                else{
                    $_SESSION['blad'] = "Niepoprawny login lub hasło."; 
                    header('Location: ../logowanie');
                }
            }
            else{
                $_SESSION['blad'] = "Niepoprawny login lub hasło."; 
                header('Location: ../logowanie');
            }
        }
        
        $polaczenie->close();
    }
?>