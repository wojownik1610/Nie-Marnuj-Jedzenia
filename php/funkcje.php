<?php



    function wstawHead(){
        echo<<<END
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap" rel="stylesheet">
END;
    }

    function wstawMenu(){
        echo<<<END
            
            <div class="logo">
                <div id="przycisk">
                    <div class="hamburger" ></div>
                </div>
                <a href="main"><div class="logo__logo"><p>Nie-Marnuj-Jedzenia.ct8.pl</p></div></a>
                    <div class="logo__menu">
                        <ul class="logo__opcje">
                            <li class="logo__opcja" onclick="window.location.href='main'">Menu</li>
                            <li class="logo__opcja" onclick="window.location.href='oferty'">Oferty</li>
                            <li class="logo__opcja" onclick="window.location.href='logowanie'">Konto</li>
END;
                    if(isset($_SESSION['zalogowany'])){
                        echo<<<END
                        <li class="logo__opcja" onclick="window.location.href='php/logout.php'">Wyloguj</li>
END;
                    }
                    else
                        echo<<<END
                        <li class="logo__opcja" onclick="window.location.href='logowanie'">Zaloguj się</li>
END;
    echo<<<END
    </ul>
                </div>
            </div>
END;
    }
    
    function wstawStopke(){
        echo<<<END
            <footer>
                <div class="footer">
                    <h2>2019 &copy;</h2>
                </div>
            </footer>
END;
    }
function mojeOferty(){
    require_once "connect.php";

    $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
    
    $rezultat = @$polaczenie->query(
            sprintf("SELECT * FROM oferty WHERE idUser='%s'",
            $_SESSION['id']
            ));

        echo "<table class='showOfert__table'><tr class='showOfert__wiersz'><td>ID</td><td>Województwo</td><td>Powiat</td><td>Miasto</td><td>Opis</td><td>Data dodania</td><td>Ustawienia</td></tr>";
    $i = 0;
    while($r = $rezultat->fetch_array()) {
        $i++;
        echo "<tr class='showOfert__wiersz'><td>$i</td><td value='".$r['woj']."'></td><td value='".$r['pow']."'></td><td>".$r['town']."</td><td>".$r['kom']."</td><td>".$r['data']."</td><td class='showOfert__delete'>Usuń</td></tr>";
    }
       
        echo "</table>";
    
    }
?>