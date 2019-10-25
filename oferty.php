<?php
    session_start();
    if( !isset($_SESSION['zalogowany'])){
        $_SESSION['blad'] = "Musisz być zalogowany, aby zobaczyć oferty.";
        header('Location: logowanie');
        exit();
    }
    include("php/funkcje.php");
?>

<!DOCTYPE html>
<html lang="pl">
<head>
   
   <?php wstawHead(); ?>
   
    <title>Oferty</title>
    <meta charset="UTF-8">
    <meta name="author" content="Patryk Lukaszewski">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/styleForm.css">
    <link rel="stylesheet" href="style/styleOferty.css">
</head>
<body>
    <?php wstawMenu(); ?>
    
    <div class="pas">
        <div class="styczne1 oferty__logo">
            <p>Strona z aktualnymi ofertami!</p>
        </div>
    </div>
    
    <div class="pas">
        <div class="styczne1 oferty__tekst bgGreen">
            Jak znaleźć odpowiednią ofertę?<br><br>
            <b>
                    1. Użyj filtru miejscowości, aby znaleźć oferty w jak najbliższej odległości od Ciebie.
                <br>
                    2. Wyszukaj interesujące Ciebie produkty (szukaj w kolumnie <font color="red">OPIS</font>).
                <br> 
                    3. Znajdź odpowiednie ogłoszenie skopiuj adres mail podany w kolumnie <font color="red">Kontakt</font>.
                <br> 
                    4. Umów się z tą osobą za pomocą e-maila na odbiór.
            </b>
        </div>
</div>
    

<div class="pas">
    <div class="styczne1 oferty__kontener">
           <div class="filtr__kontener">
              
               <h2 class="filtr__logo">Filtr miejscowości</h2>
               <form id="addOferta" action="php/ustawienie.php" method="post" >
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
                    <div class="form__linia form__linia--nizsza">
                        <label class="form__etykieta form__etykieta--szersza">Miasto/wieś
                            <input type="text" class="form__pole" id="oferty__town" name="addTown">
                        </label>
                    </div>
                    <input id="showOglo" type="button" value="Szukaj" class="form__przycisk">

                </form>
               
           </div>
            <div class="oferty__tabele">
                
                
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
    <script src="script/scriptOferty.js"></script>
</html>