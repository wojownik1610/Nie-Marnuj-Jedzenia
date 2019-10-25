<?php

    session_start();
    
    if (!isset($_POST['nazwa']) || !isset($_POST['login']) || !isset($_POST['mail']) || !isset($_POST['haslo']) || !isset($_POST['haslo2'])){
        header('Location ../rejestracja');
        exit();
    }

    require_once "connect.php";

    $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

    if($polaczenie->connect_errno!=0){
        echo "Error".$polaczenie->connect_errno;
        header('Location ../rejestracja');
    }
    else{
        $sekret = "6LfeMb8UAAAAAPLf9wdjd1Ke4lGZCiBvd1-AIpVZ";
        $sprawdz = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$sekret.'&response='.$_POST['g-recaptcha-response']);
        
        $odpowiedz = json_decode($sprawdz);
        
            if($odpowiedz->success == false){
                $_SESSION["noCaptcha"] = "Potwierdź, że nie jesteś botem.";
            }

            $nazwa = $_POST["nazwa"];
            $login = $_POST["login"];
            $mail = $_POST["mail"];
            $haslo = $_POST["haslo"];

            $nazwa = htmlentities($nazwa, ENT_QUOTES, "UTF-8");
            $login = htmlentities($login, ENT_QUOTES, "UTF-8");
            $mail = htmlentities($mail, ENT_QUOTES, "UTF-8");
            $haslo = htmlentities($haslo, ENT_QUOTES, "UTF-8");

                     $rezultatNazwa = @$polaczenie->query(
                    sprintf("SELECT * FROM user WHERE BINARY nazwa='%s'",
                    mysqli_real_escape_string($polaczenie, $nazwa)
                    ));
                    $rezultatLogin = @$polaczenie->query(
                    sprintf("SELECT * FROM user WHERE BINARY nick='%s'",
                    mysqli_real_escape_string($polaczenie, $login)
                    ));
                    $rezultatMail = @$polaczenie->query(
                    sprintf("SELECT * FROM user WHERE mail='%s'",
                    mysqli_real_escape_string($polaczenie, $mail)
                    ));
                    
                    $ileNazw = $rezultatNazwa->num_rows;
                    $ileLogin = $rezultatLogin->num_rows;
                    $ileNazwa = $rezultatNazwa->num_rows;
                    $ileMail = $rezultatMail->num_rows;

                    if($ileNazw + $ileLogin + $ileNazwa + $ileMail > 0 || isset($_SESSION["noCaptcha"])){
                        if($ileNazw > 0)
                            $_SESSION["isNazwa"] = "Taka nazwa juz istnieje.";
                        if($ileLogin > 0)
                            $_SESSION["isLogin"] = "Taki login juz istnieje.";
                        if($ileNazwa > 0)
                            $_SESSION["isNazwa"] = "Taka nazwa juz istnieje.";
                        if($ileMail > 0)
                            $_SESSION["isMail"] = "Taki mail jest już używany.";
                        
                            $_SESSION["nazwa"] = $nazwa;
                            $_SESSION["login"] = $login;
                            $_SESSION["mail"] = $mail;
                            $_SESSION["haslo"] = $haslo;
                        header('Location: ../rejestracja');
                    }
                    else{
                        $haslo_hash = password_hash($haslo, PASSWORD_DEFAULT);
                        @$polaczenie->query(
                        sprintf("INSERT INTO user (nazwa, nick, mail, haslo) VALUES ('%s', '%s', '%s', '%s')",
                        mysqli_real_escape_string($polaczenie, $nazwa),
                        mysqli_real_escape_string($polaczenie, $login),
                        mysqli_real_escape_string($polaczenie, $mail),
                        mysqli_real_escape_string($polaczenie, $haslo_hash)
                            ));
                        $_SESSION['rejestracja'] = "Konto zostało utworzone pomyslnie.";
                        header('Location: ../logowanie');
                    }
                

        
        $polaczenie->close();
    }
?>