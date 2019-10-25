<?php
    session_start();
    if( isset($_SESSION['zalogowany']) && ($_SESSION['zalogowany']==true)){
        header('Location: konto');
        exit();
    }
    include("php/funkcje.php");
?>

<!DOCTYPE html>
<html lang="pl">
<head>
   
   <?php wstawHead(); ?>
   
    <title>Logowanie</title>
    <meta charset="UTF-8">
    <meta name="author" content="Patryk Lukaszewski">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/styleForm.css">
    <link rel="stylesheet" href="style/styleFirmy.css">
</head>
<body>
    <?php wstawMenu(); ?>
    
    <div class="pas">
        <div class="styczne2 bgGreen">
            <p class="firmy__tekst">
                <b>
                    W Polsce każdego roku marnuje się około 9 mln ton jedzenia wartego ok. 14 mld euro.<br><br>
                    <font color="red" size="40px">To ponad 60 mld zł.</font>
                </b>
            </p>
        </div>
        <div class="styczne2 login">
            <form action="php/zaloguj.php" method="post" class="login__kontener">
                <div class="form__linia">
                    <label class="form__etykieta">Login: <input type="text" name="login" class="form__pole"/></label>
                </div>
                <div class="form__linia">
                    <label class="form__etykieta">Hasło: <input type="password" name="haslo" class="form__pole"/></label>
                </div>
                <input type="submit" value="Zaloguj się" class="form__przycisk"/>
                <input type="button" class="form__przycisk2" onclick="window.location.href='rejestracja' " value="Rejestracja"/>
            </form>
            <div class="login__alertPHP">
                <?php
                    if(isset($_SESSION['blad'])){
                        echo $_SESSION['blad'];
                        unset($_SESSION['blad']);
                    }
                    if(isset($_SESSION['rejestracja'])){
                        echo $_SESSION['rejestracja'];
                        unset($_SESSION['rejestracja']);
                    }
                    if(isset($_SESSION['afterDeleteAcc'])){
                        echo $_SESSION['afterDeleteAcc'];
                        unset($_SESSION['afterDeleteAcc']);
                    }
                ?>
            </div>
            
        </div>
    </div>
       
        <?php wstawStopke(); ?>

</body>

    <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous">
    </script>
    <script src="script/script.js"></script>
</html>