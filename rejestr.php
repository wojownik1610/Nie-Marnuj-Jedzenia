<?php
    session_start();
    if( isset($_SESSION['zalogowany']) && ($_SESSION['zalogowany']==true)){
        header('Location: firmyZ.php');
        exit();
    }
    include("php/funkcje.php");
?>

<!DOCTYPE html>
<html lang="pl">
<head>
   
   <?php wstawHead(); ?>
   
    <title>Rejestracja</title>
    <meta charset="UTF-8">
    <meta name="author" content="Patryk Lukaszewski">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/styleForm.css">
    <link rel="stylesheet" href="style/styleRejestr.css">
    
    <link rel="stylesheet" href="style/fontello/rejestr/fontello.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
    <?php wstawMenu(); ?>
    
    <div class="pas">
        <div class="styczne1 rejestr__logo">
            Utwórz nowe konto całkowicie za darmo! 
        </div>
    </div>
  <div class="pas">
        <div class="styczne1 rejestr__info">
            <font size="21px" color="red">
                <b>Dane potrzebne do rejestracji:</b>
            </font>
                <br><br>
            <b>1. Nazwa: </b>
                <br> musi zawierać od 5 do 20 znaków. Może składać się z liter, cyfr oraz polskich znaków. Będzie widoczny przy każdym twoim ogłoszeniu. 
                <br><br>
            <b>2. Login: </b>
                <br> musi zawierać od 5 do 20 znaków. Może składać się z liter, cyfr oraz polskich znaków. Będzie słuzył do logowania się na konto. 
                <br><br>
            <b>3. E-mail: </b>
                <br> będzie widoczny przy każdym twoim ogłoszeniu oraz będzie służył do kontaktu z innymi użytkownikami. 
                <br><br>
            <b>4. Hasło/Powtórz hasło: </b>
                <br> oba pola muszą być identyczne. Muszą zawierać od 8 do 24 znaków. Hasło może być zbudowane z: 
                    <b>małych liter, dużych liter, polskich znaków, cyfr, oraz ze znaków !#%*+/*~.</b> 
                <br>
        </div>
    </div>
    
    <div class="pas rej">
        <div class="styczne1 rejestr" id="rejestr">
            <form action="php/Urejestrowanie.php" method="post" class="rejestr__kontener" id="rejestr">
              
               <div class="form__linia">
                   <label class="form__etykieta">
                       Nazwa: <input type="text" name="nazwa" id="nazwa" class="form__pole" value="<?php if(isset($_SESSION['nazwa'])) { echo $_SESSION['nazwa']; unset($_SESSION['nazwa']); } ?>"/>
                   </label>
                   <div id="k_nazwa" class="form__ikonka"></div>
                   <div id="n_nazwa" class="form__dymek">
                       <?php if( isset($_SESSION['isNazwa'])){
                                echo $_SESSION['isNazwa'];
                                unset($_SESSION['isNazwa']);
                            }
                       ?>    
                   </div>
               </div>
               <div class="form__linia">
                   <label class="form__etykieta">
                       Login: <input type="text" name="login" id="login" class="form__pole" value="<?php if(isset($_SESSION['login'])) { echo $_SESSION['login']; unset($_SESSION['login']); } ?>"/>
                   </label>
                   <div id="k_login" class="form__ikonka"></div>
                   <div id="n_login" class="form__dymek">
                       <?php if( isset($_SESSION['isLogin'])){
                                echo $_SESSION['isLogin'];
                                unset($_SESSION['isLogin']);
                            }
                       ?>    
                   </div>
               </div>
               <div class="form__linia">
                   <label class="form__etykieta">
                       E-Mail: <input type="text" name="mail" id="mail" class="form__pole" value="<?php if(isset($_SESSION['mail'])) { echo $_SESSION['mail']; unset($_SESSION['mail']); } ?>"/>
                   </label>
                   <div id="k_mail" class="form__ikonka"></div>
                   <div id="n_mail" class="form__dymek">
                       <?php if( isset($_SESSION['isMail'])){
                                echo $_SESSION['isMail'];
                                unset($_SESSION['isMail']);
                            }
                       ?>    
                   </div>
               </div>
               <div class="form__linia">
                   <label class="form__etykieta">
                       Hasło: <input type="password" name="haslo" id="haslo" class="form__pole" value="<?php if(isset($_SESSION['haslo'])){ echo $_SESSION['haslo'];} ?>"/>
                   </label>
                   <div id="k_haslo" class="form__ikonka"></div>
                   <div id="n_haslo" class="form__dymek"></div>
               </div>
               <div class="form__linia">
                   <label class="form__etykieta">
                       Powtórz hasło: <input type="password" name="haslo2" id="haslo2" class="form__pole" value="<?php if(isset($_SESSION['haslo'])){ echo $_SESSION['haslo']; unset($_SESSION['haslo']); } ?>"/>
                   </label>
                   <div id="k_haslo2" class="form__ikonka"></div>
                   <div id="n_haslo2" class="form__dymek"></div>
               </div>
               
                <div class="g-recaptcha form__captcha" data-sitekey="6LfeMb8UAAAAAKVZU0uOs0JDsTAaI2ng14nhPIwM"></div>
                <div id="n_captcha" class="form__dymek">
                       <?php if( isset($_SESSION['noCaptcha'])){
                                echo $_SESSION['noCaptcha'];
                                unset($_SESSION['noCaptcha']);
                            }
                       ?>    
                </div>
                <input type="button" class="form__przycisk"  value="Zarejestruj"/>
            </form>
        </div>
    </div>


        <?php 
            wstawStopke(); 
            session_unset();
        ?>


</body>

    <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous">
    </script>
    <script src="script/script.js"></script>
    <script src="script/scriptRejestr.js"></script>
</html>