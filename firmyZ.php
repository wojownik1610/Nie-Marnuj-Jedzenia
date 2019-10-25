<?php
    session_start();
    if( !isset($_SESSION['zalogowany']) || ($_SESSION['zalogowany']==false)){
        header('Location: logowanie');
        exit();
    }
    include("php/funkcje.php");
?>


<!DOCTYPE html>
<html lang="pl">
<head>
   
   <?php wstawHead(); ?>
   
    <title>Konto</title>
    <meta charset="UTF-8">
    <meta name="author" content="Patryk Lukaszewski">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/styleForm.css">
    <link rel="stylesheet" href="style/styleFirmyZ.css">
</head>
<body>
   
    <?php wstawMenu(); ?>
    
    <div class="pas">
        <div class="styczne1 hello">
            <?php
                echo"<p>WITAJ ".$_SESSION['user']."!";
            ?>
        </div>
    </div>
    

<div class="pas">
    <div class="styczne2 ustawienia__kontenerAll">
            <div class="ustawienia__logo">Ustawienia</div>
            <ul class="ustawienia__lista">
                <li class="ustawienia__opcja
                           <?php
                          if(!isset($_SESSION['changeNameBlad']) && !isset($_SESSION['deleteBlad']))
                                echo " ustawienia__opcja--wybrany";
                          ?> 
                           " id="changePas">Zmiana hasła</li>
                <li class="ustawienia__opcja
                           <?php
                          if(isset($_SESSION['changeNameBlad']))
                                echo " ustawienia__opcja--wybrany";
                          ?> 
                           " id="changeName">Zmiana nazwy</li>
                <li class="ustawienia__opcja
                           <?php
                          if(isset($_SESSION['deleteBlad']))
                                echo " ustawienia__opcja--wybrany";
                          ?> 
                           " id="deleteAcc">Usunięcie konta</li>
            </ul>
            
            <div class="ustawienia__kontener">
                <form action="php/ustawienie.php" method="post" class="zmianaHasla__kontener ust
                       <?php
                          if(!isset($_SESSION['changeNameBlad']) && !isset($_SESSION['deleteBlad']))
                                echo " ust--block";
                          ?>
                    " id="f_but1">
                    <div class="form__linia">
                        <label class="form__etykieta">Nowe hasło: <input type="password" name="haslo1" class="form__pole"/></label>
                    </div>
                    <div class="form__linia">
                        <label class="form__etykieta jednalinia">Powtórz hasło: <input type="password" name="haslo2" class="form__pole"/></label>
                    </div>
                    <div class="form__linia">
                        <label class="form__etykieta">Stare hasło: <input type="password" name="haslo3" class="form__pole"/></label>
                    </div>
                    <input type="button" value="Zmień hasło" class="form__przycisk ustawienia__przycisk" id="but1"/>
                    <div id="a_but1" class="ustawienia__alert ustawienia__alert--none">.</div>
                    <div class="ustawienia__alertPHP">
                           <?php
                            if( isset($_SESSION['changePassBlad'])){
                                echo $_SESSION['changePassBlad'];
                                unset($_SESSION['changePassBlad']);
                            }
                        ?></div>
                </form>
                
                <form action="php/ustawienie.php" method="post" class="zmianaNazwy__kontener ust 
                       <?php
                          if(isset($_SESSION['changeNameBlad']))
                                echo " ust--block";
                          ?>
                    " id="f_but2">
                    <div class="form__linia">
                        <label class="form__etykieta">Nowa nazwa: <input type="text" name="nNazwa" class="form__pole"/></label>
                    </div>
                    <div class="form__linia">
                        <label class="form__etykieta">Hasło: <input type="password" name="nHaslo" class="form__pole"/></label>
                    </div>
                    <input type="button" value="Zmień nazwa" class="form__przycisk ustawienia__przycisk" id="but2"/>
                    <div id="a_but2" class="ustawienia__alert">.<br>.</div>
                    <div class="ustawienia__alertPHP">
                        <?php
                            if( isset($_SESSION['changeNameBlad'])){
                                echo $_SESSION['changeNameBlad'];
                                unset($_SESSION['changeNameBlad']);
                            }
                        ?>
                    </div>
                </form>
                
                <form action="php/ustawienie.php" method="post" class="delete__kontener ust 
                       <?php
                          if(isset($_SESSION['deleteBlad']))
                                echo " ust--block";
                          ?>
                    ">
                    <div class="form__linia">
                        <label class="form__etykieta">Login: <input type="text" name="dLogin" class="form__pole"/></label>
                    </div>
                    <div class="form__linia">
                        <label class="form__etykieta">Hasło: <input type="password" name="dHaslo" class="form__pole"/></label>
                    </div>
                    <input type="submit" value="Usuń konto" class="form__przycisk ustawienia__przycisk"/>
                    <div class="ustawienia__alertPHP">
                        <?php
                            if( isset($_SESSION['deleteBlad'])){
                                echo $_SESSION['deleteBlad'];
                                unset($_SESSION['deleteBlad']);
                            }
                        ?>
                    </div>
                </form>
                
            </div>
            
        </div>    
    <div class="styczne2 oferty">
            <div class="oferty__logo">Oferty</div>
            <ul class="oferty__lista">
                <li class="oferty__opcja ustawienia__opcja--wybrany" id="addOferty">Nowa oferta</li>
                <li class="oferty__opcja" id="changeOferty">Przegląd ofert</li>
            </ul>
            <form class="oferty__kontener" id="addOferta" action="php/ustawienie.php" method="post" >
               <div class="form__linia form__linia--nizsza">
                   <label class="form__etykieta form__etykieta--szersza"> Województwo
                        <select id="oferty__woj" class="form__lista" name="addWoj">
                            <option value=0>Wybierz województwo</option>
                        </select>
                    </label>
               </div>
                
                <div class="form__linia form__linia--nizsza">
                    <label class="form__etykieta form__etykieta--szersza"> Powiat
                        <select id="oferty__pow" class="form__lista" name="addPow">
                            <option value=0>Wybierz powiat</option>
                        </select>
                    </label>
                </div>
                <div class="form__linia form__linia--nizsza">
                    <label class="form__etykieta form__etykieta--szersza"> Gmina
                        <select id="oferty__gmi" class="form__lista" name="addGmi">
                            <option value=0>Wybierz gmine</option>
                        </select>
                    </label>
                </div>
                <div class="form__linia ">
                    <label class="form__etykieta form__etykieta--szersza">Miasto/wieś (max 50 znaków)
                        <input type="text" class="form__pole" id="oferty__town" name="addTown">
                    </label>
                </div>
                <label class="form__etykieta form__etykieta--szersza">Co masz do oddania? <br>(Opisz, najlepiej szczegółowo, max 250 znaków)</label>
                <label class="form__etykieta form__etykieta--szersza" >
                    <textarea class="form__textarea" id="oferty__textArea" name="addArea"></textarea>
                </label>
                <input id="addOglo" type="button" value="Dodaj" class="form__przycisk">
                
            </form>
            
            <div class="oferty__kontener oferty__kontenerShow" style="display: none">
                <?php mojeOferty(); ?>
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
    <script src="script/scriptFirmyZ.js"></script>
</html>