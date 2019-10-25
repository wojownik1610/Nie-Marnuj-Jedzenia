
$(function(){
    //po załadowaniu strony
    
        stopkaNaDole(); //ustawienie stopki
        ustawienieLogo();  //ustawnienie .logo
        zmianaWielkosci(); // ustawienie napisu .logo__logo
    
    //po skrolowaniu 
    $(window).scroll( function(){
        //animacje pojawiania się kafelków
            aniamcjaPokazywania(".styczne1");
            aniamcjaPokazywania(".styczne2");
            aniamcjaPokazywania(".styczne4");
        //odpowiednie ustawienie .logo
            ustawienieLogo();
    });
    
    //rozwinięcie/zwinięcie menu, które jest gdy strona ma mniej niż 700px szerokości
        $("#przycisk").click(function(){ rozwin(0); });
    
    //po zmianie wielkości okna
        $(window).resize( function(){ 
            zmianaWielkosci(); // ustawienie napisu .logo__logo
            stopkaNaDole(); //ustawienie stopki
        });
    
});

$(document).click(function (event) {
  //zwijanie rozwijanego menu po kliknięciu obok niego
    if( $(".logo__menu").css("left") != "0px") return;
      
    if ($(event.target).closest(".logo__menu").length === 0 && $(event.target).closest(".hamburger").length === 0) {
        rozwin(1);
    }
});

function ustawienieLogo(){
    //zarządza zachowaniem  (.logo) podczas przewijania

    var ScrollY = $(window).scrollTop();
    
        //w zależności od tego jak dużo jest zeskrolowanej strony zmienia sie .logo
        
        if(ScrollY <=15){
            $(".logo").css({height: "80px", marginTop: "15px", marginBottom: "15px", position: "relative"});
        }
        if(ScrollY>15 && ScrollY<=35){
            $(".logo").css({height: (95-ScrollY)+"px", marginTop: ScrollY+"px", marginBottom: "15px", position: "relative"});
        }
        if(ScrollY>35 && ScrollY<=50){
            $(".logo").css({height: "60px", marginTop: ScrollY+"px", marginBottom: (50-ScrollY)+"px", position: "relative"});
        }
        if(ScrollY>50){
           
             $("body").css("marginTop", "110px");
             $(".logo").css({height: "60px", marginTop: "0px", marginBottom: "0px", position: "fixed"});
        }
        else{
            $("body").css("marginTop", "0px");
        }
    
}

function aniamcjaPokazywania(clasName){
    /*
        funkcja dzięki której kafelki pojawiają się dopiero, gdy są widoczne na monitorze
        
        funcka sprawia, że elementy pojawiają się w sposób płynny
    */
    
    var ScrollY = $(window).scrollTop(); //o ile została zescrolowana strona
    var HeightW = $(window).height(); //ile px ma monitor w height
    
    var ileDzieci = $(clasName).length; //ile dzieci jest w klasie 
    var childTop;   //ile px dziecko od góry ma do górnej krawędzi strony
    var childBottom;    //ile px dziecko od dołu ma do górnej krawędzi strony
    var child;  //uchwyt dzieck
    
    for(var i=0; i<ileDzieci; i++){
        //uzupełnianie zmiennych
            child = $(clasName+":eq("+i+")");
            childTop = child.offset().top;
            childBottom = childTop + child.innerHeight();
        
        //sprawdzanie czy górna krawędź el jest widoczna, lub dolnacz
        if((childBottom > ScrollY+70 && childBottom <  ScrollY + HeightW-10) || (childTop > ScrollY+70 && childTop <  ScrollY + HeightW-10) || (childTop <= ScrollY+70 && childBottom >=  ScrollY + HeightW-10)){
                if(child.css("opacity") == 1) continue;
                    child.css("opacity", "1");
                    child.css("transform", "scale(1)");
        }
        else{
            if(child.css("opacity") == 0) continue;
                child.css("opacity", "0");
                child.css("transform", "scale(0.85)");
        }
    }
    
}

function zmianaWielkosci(){
    /*
        funkcja dzięki której napis w .logo__logo zmienia swoją wielkość wraz ze zmianą wielkości strony
    */
    
    
    //pobranie wielkości czcionki oraz usunięcie "px" i zamiana ze string na int
    var fontSize = $(".logo__logo").css("fontSize");
    fontSize = fontSize.slice(0, fontSize.length-2);
    fontSize = parseInt(fontSize);
    
    //pobranie wysokości pojemnika na tekst oraz usunięcie "px" oraz zamiana na int
    var hLogo = $(".logo__logo>p").css("height");
    hLogo = hLogo.slice(0, hLogo.length-2);
    hLogo = parseInt(hLogo);

    var i = fontSize;
    
    //sprawdszenie czy tekst mieści się w jednej linii, pojedyńcz linia ma height 60px
    if(hLogo <= 60){
            //jeżeli tekst mieści się w jednej linii, czyli można zwiększyć czcionkę
        
        for( i ; hLogo <= 60; i++){
            //za pomocą for szukanie największej czcionki, przy której tekst mieści się w jednej linii
            
            $(".logo__logo").css("fontSize", i+"px"); //ustawienie czcionki
            hLogo = $(".logo__logo>p").css("height"); //sprawdzenie wysokości i usunięcie "px"
            hLogo = hLogo.slice(0, hLogo.length-2);
            hLogo = parseInt(hLogo);
            
        }
        
    }
    else{
        //jeżeli tekst nie mieści się w jednej linii, czyli trzeba zmniejszyć czcionkę
        
        for( i ; hLogo > 60; i--){
            //szukanie największej czcionki która sprawi że tekst zmieści się w jednej linii
            
            $(".logo__logo").css("fontSize", i+"px");
            hLogo = $(".logo__logo>p").css("height");
            hLogo = hLogo.slice(0, hLogo.length-2);
            hLogo = parseInt(hLogo);
            
        }
        
    }
    
        i-=4; // zmiejszenie czcionki, aby nie była maxymalna która się mieści
        
        $(".logo__logo").css("fontSize", i+"px"); // ustawienie wyliczonej wielkości
    
    
    var szerOkna = window.innerWidth; 
    if(szerOkna <= 699){
        //jeżeli szerokość okna jest mniejsza niż 700 to dodanie animacji rozwijanie menu 
        
        $(".logo__menu").css('transition-duration','250ms');  
        
    }
    else{
        //jeżeli szerokość okna jest większa niż 699 to usunięcie animacji rozwijanie menu 
        // oraz wywołanie funkcji która zwinie rozwijane menu
        
       $(".logo__menu").css('transition-duration',''); 
        rozwin(1);
    }
    
}

function rozwin(co){
    /*
        Funkcja jest stworzona do rozwijania i zwijania menu bocznego, które pojawia sie,
        gdy szerokośc strony jest mniejsza, niż 700px
    
    */
    
    if(co == 1){
        /*
            zmienna co przyjmuje wartość 1, gdy okno przeglądarki zmieni swoją szerokość i będzie miało ponad 699px
            
            ta funkcja powoduje, że menu zostanie zwinięte, więc po zmianie szerokości strony na mnij niż 700 
            menu zawsze będzie schowane
        */
        
        $(".hamburger").removeClass("hamburgerClick"); // usuwanie klasy dzięki której przycisk hamburger ma kształt X
        $(".logo__menu").removeClass("logo__menu--rozw"); // usuwanie klasy dzięki której menu ma ustawione left na 0px
        return;
    }
    
    // rozwijanie/zwijanie menu naprzemiennie oraz zmiana przycisku hamburger z 3 kresek na X i z powrotem
    $(".hamburger").toggleClass("hamburgerClick");
    $(".logo__menu").toggleClass("logo__menu--rozw");
    
}

function stopkaNaDole(){
        /*
            Powoduje, że stopka (.footrer) jest zawsze przy dolnej krawędzi body.
            
            Uwaga:
                footer ma ustawione position:absolute, 
                ale na stronie oferty.php ma ustawione position:static, 
                więc ta funkcja nie nie zmienia na ww. witrynie. 
        */
    
        //kończenie funkcji, gdy position == "static", czyli gdy odpalona jest oferty.php
//if($(".footer").css("position") == "static") return;
    
    var hStrony = window.innerHeight;   //pobiera wysokość okna przeglądarki
    var dlugoscStrony = document.body.scrollHeight; //pobiera długość strony
    
        //Sprawdzenie czy okno przeglądarki jest dłuższe od długości strony
        //jeżeli tak jest to ustawia zmienną z długością strony na wysokość przeglądarki
    if(dlugoscStrony < hStrony){
        
        hStrony-=47;  //odejmuje od dlugoscStrony wysokość stopki
        $(".footer").css("top", hStrony+"px");  //ustawia odległość od górnej krawędzi
        $(".footer").css("position", "");
        
    } 
    else{
        $(".footer").css("position", "static");
    }

    //ustawienie display: block, pierwotnie, po odpaleniu strony jest ustawione display: none
    $(".footer").css("display", "block");   
}
