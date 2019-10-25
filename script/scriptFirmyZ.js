

window.onload = function(){
    
    xml(null, false);
    
    document.getElementById("changePas").addEventListener("click", function(){ opcja(0);});
    document.getElementById("changeName").addEventListener("click", function(){ opcja(1);});
    document.getElementById("deleteAcc").addEventListener("click", function(){ opcja(2);});
    
    document.getElementById("addOferty").addEventListener("click", function(){ oferty(0);});
    document.getElementById("changeOferty").addEventListener("click", function(){ oferty(1);});
    
    var klasa = document.getElementsByClassName("ustawienia__przycisk");
    for(var i=0; i<klasa.length-1; i++){
        klasa[i].addEventListener("click", function(){ submitUstaw(this);})
    }
    var alert = document.getElementsByClassName("ustawienia__alert");
    for(var i=0; i<alert.length; i++){
        $(".ustawienia__alert:eq("+i+")").addClass("ustawienia__alert--none");
    }
    
    xml(1, true);
    $("#oferty__woj").change(function(){ xml(2, true); });
    $("#oferty__pow").change(function(){ xml(3, true); });
    
    $("#addOglo").click(function(){ addOglo(); });
    
    $(".showOfert__delete").click(function(){ usunOgloszenie(this);});
    elementyDoZmniejszania();
    
}
  $(window).resize(function(){
       elementyDoZmniejszania();
   });
  
  function elementyDoZmniejszania(){
  
     var elChild = document.getElementsByClassName("ustawienia__kontener");
  var elParent = document.getElementsByClassName("ustawienia__kontenerAll")[0];
     automatycznaZmianaRozmiaru( elChild, elParent);
    
    elChild = document.getElementsByClassName("ustawienia__opcja");
    automatycznaZmianaRozmiaru( elChild, elParent);
    
  
    elParent = document.getElementsByClassName("oferty")[0];
  elChild = document.getElementsByClassName("oferty__kontener")[0];
  automatycznaZmianaRozmiaru( elChild, elParent);
  
  }

function automatycznaZmianaRozmiaru(elChild, elParent){
  
    var szerokoscStrony = $(elParent).width()-8;
    var szerEl = $(elChild).innerWidth();

  if(szerokoscStrony < szerEl ){
    var skala = szerokoscStrony / szerEl ;
    skala = "scale("+skala+")";
       $(elChild).css({transform: skala});
       $(elChild).css({transformOrigin: "left"});
    }
  else{
        $(elChild).css({transform: "scale(1)"});
        $(elChild).css({transformOrigin: ""});
    }
  
  
  }


    function spisOgloszenUzupelnienie(xml){
        
            var xmlDoc = xml.responseXML;
            var x = xmlDoc.getElementsByTagName("row");
            var woj;
            var pow;
            var wojName;
            var powName;
        
        var wiersze = document.getElementsByClassName("showOfert__wiersz");
        var ile = wiersze.length;
        
        for(var i=1; i<ile; i++){
            wojName=null;
            powName=null;
            woj = wiersze[i].children[1].getAttribute("value");
            pow = wiersze[i].children[2].getAttribute("value");
            
            for(var j=0; j<x.length && ( wojName==null || powName==null); j++){
                
                if(x[j].getElementsByTagName("NAZWA_DOD")[0].childNodes[0].nodeValue.indexOf("województwo") != -1 &&
                    x[j].getElementsByTagName("WOJ")[0].childNodes[0].nodeValue == woj){
                    wojName = x[j].getElementsByTagName("NAZWA")[0].childNodes[0].nodeValue;
                }
                if(x[j].getElementsByTagName("NAZWA_DOD")[0].childNodes[0].nodeValue.indexOf("powiat") != -1 &&
                   x[j].getElementsByTagName("WOJ")[0].childNodes[0].nodeValue == woj &&
                    x[j].getElementsByTagName("POW")[0].childNodes[0].nodeValue == pow){
                    powName = x[j].getElementsByTagName("NAZWA")[0].childNodes[0].nodeValue;
                }
        
            }
            wiersze[i].children[1].innerHTML = wojName;
            wiersze[i].children[2].innerHTML = powName;
            
            
        }
    }

    function usunOgloszenie(el){
        //usunięcie ogłoszenia z bazy danych
        
        var elPar = el.parentElement.children;
        var woj = elPar[1].getAttribute("value");
        var pow = elPar[2].getAttribute("value");
        var town = elPar[3].innerHTML;
        var kom = elPar[4].innerHTML;
        var data = elPar[5].innerHTML;
        
        
        $.ajax({
            type:"POST",
            url:"php/deleteOglo.php",
            data: {woj:woj, pow:pow, town:town, kom:kom, data:data}, 
        });
        elParent = el.parentElement;
        setTimeout(function(){ 
            elParent.parentElement.removeChild(elParent);
            var ile = $(".showOfert__wiersz").length;
            var elID = $(".showOfert__wiersz > td:first-child");
            
            for(var i=1; i<ile; i++){
                elID.eq(i).html(i);
            }
        }, 300);
    }

    function oferty(id){
        /*
            funkcja wyświetlająca odpowiednią kartę z 'Oferty'
        */
        var menuOferty = document.getElementsByClassName("oferty__opcja");
        var kontenerOferty = document.getElementsByClassName("oferty__kontener");
        
        for(var i=0; i<menuOferty.length; i++){
            
            if(i == id){
                
                $(menuOferty[i]).addClass("ustawienia__opcja--wybrany");
                $(kontenerOferty[i]).css("display", "block");
                
            }
            else{
                
                $(menuOferty[i]).removeClass("ustawienia__opcja--wybrany");
                $(kontenerOferty[i]).css("display", "none");
                
            }
        }
        
    }

    function addOglo(){
        /*
            funkcja dodająca ogłoszenie
        */
        var wszystkoOK = true;
        if( document.getElementById("oferty__woj").value == 0){
            wszystkoOK = false;
            $("#oferty__woj").addClass("form__pole--bgRed");
        }
        else{
            $("#oferty__woj").removeClass("form__pole--bgRed");
        }
        
        if( document.getElementById("oferty__pow").value == 0){
            wszystkoOK = false;
            $("#oferty__pow").addClass("form__pole--bgRed");
        }
        else{
            $("#oferty__pow").removeClass("form__pole--bgRed");
        }
        
        if( document.getElementById("oferty__gmi").value == 0){
            wszystkoOK = false;
            $("#oferty__gmi").addClass("form__pole--bgRed");
        }
        else{
            $("#oferty__gmi").removeClass("form__pole--bgRed");
        }
        
        if( document.getElementById("oferty__town").value == "" || document.getElementById("oferty__town").value.length > 50){
            wszystkoOK = false;
            $("#oferty__town").addClass("form__pole--bgRed");
        }
        else{
            $("#oferty__town").removeClass("form__pole--bgRed");
        }
        
        if( document.getElementById("oferty__textArea").value == "" || document.getElementById("oferty__textArea").value.length > 250){
            wszystkoOK = false;
            $("#oferty__textArea").addClass("form__pole--bgRed");
        }
        else{
            $("#oferty__textArea").removeClass("form__pole--bgRed");
        }
        
        if( wszystkoOK ){//jeżeli wszystkie pola zostały poprawnie zaznaczone to wysłanie formularza i dodanie ogłoszenia
            document.forms["addOferta"].submit();
        }
        
        
    }

    function xml(co, czyLista){
        //łączenie z plikiem xml
          var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if(czyLista)
                    odczytXML(this, co);
                else
                    spisOgloszenUzupelnienie(this);
            }
          };
          xhttp.open("GET", "xml/xml.xml", true);
          xhttp.send();
    }
    function odczytXML(xml, co) {
        /*
            odczyt danych z pliku xml
        */
          var xmlDoc = xml.responseXML;
          var x = xmlDoc.getElementsByTagName("row");
            var nazwa;
            var id;
            var option;
        
            switch(co){
                case 1:
                    option = document.getElementById("oferty__woj");
                    break;
                case 2:
                    option = document.getElementById("oferty__pow");
                    break;
                case 3:
                    option = document.getElementById("oferty__gmi");
                    break;
            }
            
            if(co > 1){
                while( option.lastChild != option.firstChild){
                    option.removeChild(option.lastChild);
                }
                switch(co){
                        case 2: 
                            option.innerHTML = "<option value=0>Wybierz powiat</option>";
                        case 3:
                            document.getElementById("oferty__gmi").innerHTML = "<option value=0>Wybierz gmine</option>";
                }
                
            }
            
          for (var i = 0; i <x.length; i++) {
              
              switch(co){
                  case 1:
                      //lista województw
                      if(x[i].getElementsByTagName("NAZWA_DOD")[0].childNodes[0].nodeValue.indexOf("województwo") != -1 ){
                          nazwa = x[i].getElementsByTagName("NAZWA")[0].childNodes[0].nodeValue;
                          id = x[i].getElementsByTagName("WOJ")[0].childNodes[0].nodeValue;
                          option.innerHTML += "<option value='"+id+"'>"+nazwa+"</option>";
                      }
                      break;
                case 2:
                      //lista powiatów w określonych województwie
                      var nrWoj = document.getElementById("oferty__woj").value;
                      
                      if(x[i].getElementsByTagName("NAZWA_DOD")[0].childNodes[0].nodeValue.indexOf("powiat") != -1 &&
                           x[i].getElementsByTagName("WOJ")[0].childNodes[0].nodeValue == nrWoj ){
                          
                          nazwa = x[i].getElementsByTagName("NAZWA")[0].childNodes[0].nodeValue;
                          id = x[i].getElementsByTagName("POW")[0].childNodes[0].nodeValue;
                          option.innerHTML += "<option value='"+id+"'>"+nazwa+"</option>";
                      }
                      break;
                case 3:
                      //lista gmin w określonym powiecie
                      var nrWoj = document.getElementById("oferty__woj").value;
                      var nrPow = document.getElementById("oferty__pow").value;
                      
                      if(x[i].getElementsByTagName("NAZWA_DOD")[0].childNodes[0].nodeValue.indexOf("gmina") != -1 &&
                           x[i].getElementsByTagName("WOJ")[0].childNodes[0].nodeValue == nrWoj &&
                            x[i].getElementsByTagName("POW")[0].childNodes[0].nodeValue == nrPow){
                          
                          nazwa = x[i].getElementsByTagName("NAZWA")[0].childNodes[0].nodeValue;
                          id = x[i].getElementsByTagName("GMI")[0].childNodes[0].nodeValue;
                          option.innerHTML += "<option value='"+id+"'>"+nazwa+"</option>";
                      }
                      break;
              }
                      
         }
              
        }
    

function opcja(id){
    /*
        funkcja która powoduje że wyświetla się odpowiednia 'karta' z opcjami.
    */
    var klasa = document.getElementsByClassName("ust");
    var opcje = document.getElementsByClassName("ustawienia__opcja");
    var alert = document.getElementsByClassName("ustawienia__alert");
    
    for(var i=0; i<klasa.length; i++){
        if(i != id){
            //zmiana ustawień dla kart różnych od klikniętej
                klasa[i].classList.remove("ust--block");
                opcje[i].classList.remove("ustawienia__opcja--wybrany");
        }
        else{
            //zmiana usatwień dla karty która ma zostać pokazana
                klasa[i].classList.add("ust--block");
                opcje[i].classList.add("ustawienia__opcja--wybrany");
                if(id!=2) //w 'ustawienia' w opcji 2 czyli 'usuń konto' nie ma alert[i]
                    alert[i].classList.add("ustawienia__alert--none");
        }
    }
}

function submitUstaw(el){
    /*
        funkcja sprawdzająca czy formularz spełnia validacje, oraz wysyła formularz
    */
    var el1;
    var el2;
    var elReg;
    var alert = "";
    var wszystkoOk = true; //założenie że wszystko jest spełnione i teraz sprawdzenie czy tak jest
    
    //sprawdzenie jaki formularz został wysłany
    switch(el.id){
            
        case "but1":
            //formularz zmiany hasła
                //pobranie wpisanych nowych haseł
                    el1 = document.getElementsByName("haslo1")[0]; 
                    el2 = document.getElementsByName("haslo2")[0];
                    elReg = /^[A-ZĄĆĘÓŁŚŹŻa-ząęćżźłó0-9!#%*+/*~.]{8,24}$/;
                if(el1.value != el2.value){ //sprawdzenie czy hasła sa identyczne
                    alert = "Hasła muszą być identyczne."
                    wszystkoOk = false;
                }
                if(!elReg.test(el1.value)){ //sprawdenie czy hasło spełnia regułę
                    alert += "Hasło musi mieć od 8 do 24 znaków.";
                    wszystkoOk = false;
                }
            break;
            
        case "but2":
            //formularz zmiany nazwy użytkownika
                el1 = document.getElementsByName("nNazwa")[0]; //pobranie wpisanej nazwy
                elReg = /^[A-ZĄĆĘÓŁŚŹŻa-ząęćżźłó0-9]{5,20}$/;

                if(!elReg.test(el1.value)){
                    alert += "Nazwa musi mieć od 5 do 20 znaków.<br> Może składać się z liter i cyfr.";
                    wszystkoOk = false;
                }
            break;
    }
    
    if(wszystkoOk){     //jeżeli wszytskie warunki spełnione to formularz zostaje wysłany   
        document.forms["f_"+el.id].submit();
    }
    else{ // jeżeli warunki nie zostały spełnione to zostaje wyświetlony alert z uwagami
        document.getElementById("a_"+el.id).innerHTML = alert;
        document.getElementById("a_"+el.id).classList.remove("ustawienia__alert--none");
    }
}