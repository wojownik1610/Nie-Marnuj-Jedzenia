<?php 
    session_start();
    include("php/funkcje.php"); 
?>
<!DOCTYPE html>
<html lang="pl">
<head>
   
   <?php wstawHead(); ?>
    <title>Strona główna</title>
    <meta charset="UTF-8">
    <meta name="author" content="Patryk Lukaszewski">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/styleForm.css">
    <link rel="stylesheet" href="style/styleIndex.css">
    
</head>
<body>
    <?php wstawMenu(); ?>

<div class="pas">
        <div class="styczne1 rejestr__logo">
            Nie marnuj jedzenie, oddaj je innym. <br>
            <b>
                <font size="35px">
                    Walcz z głodem.<br>
                    Zacznij lokalnie, wygraj globalnie!
                </font>
            </b>
        </div>
    </div>

<div class="pas">
    <div class="styczne2 kafelekIndex bgPurple">
            <p>
                <b>
                    <font color="green">Daj jedzeniu drugie życie!</font><br><br>
                    Lepiej oddać produkty, niż je zmarnować!
                </b>
            </p>
        </div>    
    <div class="styczne2 kafelekIndex bgBlue">
            <p>
                <b>
                    Polacy rocznie marnują 
                    <font color="darkred">235 kg</font> żywności na osobę
                </b><br>
                informuje firma Deloitte.
            </p>
        </div>  
</div>
<div class="pas">
    <div class="styczne2 kafelekIndex bgOrange">
            <p>
                <b>
                    Aby dołączyć do naszej społeczności i wymieniać się jedzeniem, wystarczy 
                    <font color="darkred">założyć darmowe konto</font>.
                </b>
                <input type="button" class="form__przycisk2" onclick="window.location.href='rejestracja' " value="Rejestracja"/>
            </p>
            
        </div>  
        <div class="styczne2 kafelekIndex bgGrey">
            <p>
                <b>Zachęcaj znajomych, aby powiększyli społeczność osób nie marnujących jedzenia.</b>
            </p>
        </div>  
</div>
<div class="pas">
        <div class="styczne2 kafelekIndex bgGreen">
            <p>
                Dane Organizacji Narodów Zjednoczonych do spraw Wyżywienia i Rolnictwa (FAO, skrót od Food and Agriculture Organization of the United Nations) wskazują, że:
                 <b>
                     marnujemy rocznie 
                     <font color="white">1,3 miliarda ton żywności!</font><br> 
                     Jest to strata ok. 1/3 produkowanej żywności, w czasach gdy 
                     <font color="white">aż 821 milionów ludzi na świecie głoduje.</font> 
                </b>
            </p>
        </div>
        <div class="styczne2 kafelekIndex ">
            <p>
                <b>
                    <font color="white">42 procent Polaków</font> przyznaje, że zdarza im się wyrzucać żywność, 35 procent z nich robi to kilka razy w miesiącu. Najczęściej wyrzucane produkty to pieczywo, owoce, wędliny i warzywa
                </b><br><br> 
                    wynika z badania zrobionego na potrzeby Federacji Polskich Banków Żywności.
            </p>
        </div>
</div>
<div class="pas">
        <div class="styczne2 kafelekIndex bgPink">
            <p>
               Co najczęściej wyrzucają Polacy?<br><br>
                Z badań Kantar Millward Brown na zlecenie Federacji Polskich Banków Żywności wynika, że badani Polacy wśród najczęściej wyrzucanych produktów wskazują kolejno:
                <b> 
                    pieczywo (51 proc.), wędliny (49 proc.), warzywa (33 proc.), owoce (32 proc.), a także jogurty (16 proc.)
                </b>.
            </p>
        </div>
        <div class="styczne2 kafelekIndex bgBrown">
           <p>
                Według Greenpeace Polska<br>
                W Polsce co roku marnuje się około 
                <b>9 mln ton żywności</b>. 
                Pod tym względem nasz kraj <b>zajmuje niechlubne 5. miejsce</b> w Unii Europejskiej. 
            </p>
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