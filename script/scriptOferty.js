window.onload = function(){
    
    pokazOfert(0);
     xml(1, true);
    $("#oferty__woj").change(function(){
          xml(2, true); 
        pokazOfert(1);
    });
    $("#oferty__pow").change(function(){
        xml(3, true); 
        pokazOfert(2);
    });
    $("#oferty__gmi").change(function(){
        pokazOfert(3);
    });
    $("#showOglo").click(function(){
        pokazOfert(4);
    });
    
    elementyDoZmniejszania();
  
}
$(window).resize(function(){
  elementyDoZmniejszania();
});

function elementyDoZmniejszania(){
  
     var elChild = document.getElementsByClassName("filtr__kontener")[0];
  var elParent = document.getElementsByClassName("oferty__kontener")[0];
     automatycznaZmianaRozmiaru( elChild, elParent);
  
  elChild = document.getElementsByClassName("oferty__tabela");
  automatycznaZmianaRozmiaru( elChild, elParent);
  
  }

function automatycznaZmianaRozmiaru(elChild, elParent){
  
    var szerokoscStrony = $(elParent).width()-8;
  
    var ile = $(elChild).length;

  for(var i=0; i<ile; i++){
    var el = $(elChild).eq(i);
    var szerEl = el.innerWidth();
    
    if(szerokoscStrony < szerEl ){
      var skala = szerokoscStrony / szerEl ;
      skala = "scale("+skala+")";
      el.css({transform: skala});
       el.css({transformOrigin: "left"});
    }
    else{
      el.css({transform: "scale(1)"});
        el.css({transformOrigin: ""});
    }
    
    
    
    }
    
  
  
  }


function xml(co){
          var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                    odczytXML(this, co);
            }
          };
          xhttp.open("GET", "xml/xml.xml", true);
          xhttp.send();
    }
    function odczytXML(xml, co) {
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
                      if(x[i].getElementsByTagName("NAZWA_DOD")[0].childNodes[0].nodeValue.indexOf("województwo") != -1 ){
                          nazwa = x[i].getElementsByTagName("NAZWA")[0].childNodes[0].nodeValue;
                          id = x[i].getElementsByTagName("WOJ")[0].childNodes[0].nodeValue;
                          option.innerHTML += "<option value='"+id+"'>"+nazwa+"</option>";
                      }
                      break;
                case 2:
                      var nrWoj = document.getElementById("oferty__woj").value;
                      
                      if(x[i].getElementsByTagName("NAZWA_DOD")[0].childNodes[0].nodeValue.indexOf("powiat") != -1 &&
                           x[i].getElementsByTagName("WOJ")[0].childNodes[0].nodeValue == nrWoj ){
                          
                          nazwa = x[i].getElementsByTagName("NAZWA")[0].childNodes[0].nodeValue;
                          id = x[i].getElementsByTagName("POW")[0].childNodes[0].nodeValue;
                          option.innerHTML += "<option value='"+id+"'>"+nazwa+"</option>";
                      }
                      break;
                case 3:
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

function pokazOfert(co){
    
    var woj = document.getElementById("oferty__woj").value;
    var pow = document.getElementById("oferty__pow").value;
    var gmi = document.getElementById("oferty__gmi").value;
    var town = document.getElementById("oferty__town").value;
    
    if(co == 1 && woj == 0){
        co = 0;
    }
    if(co == 4){
        var ok = true;
        if( woj == 0){
            co = 0;
            ok = false;
        } 
        if( ok && pow == 0){
            co = 1;
            ok = false;
        } 
        if( ok && gmi == 0){
            co = 2;
            ok = false;
        } 
        if( ok && town == ""){
            co = 3;
        } 
    }
    $.ajax({
            type:"GET", 
            url:"php/getOferty.php", 
            contentType:"application/json; charset=utf-8", 
            dataType:'json',
            data: {woj:woj, pow:pow, gmi:gmi, town:town, co:co},
             
                
                success: function(json) { 
                    var tabele = document.getElementsByClassName("oferty__tabele")[0];
                    
                        tabele.innerHTML = "";
                        var i=0;
                    for (var klucz in json)
                        {
                            var wiersz = json[klucz];     
                            var woj = wiersz[1];
                            var pow = wiersz[2];
                            var gmi = wiersz[3];
                            var miasto = wiersz[4];
                            var kom = wiersz[5];
                            var idUser = wiersz[6];
                            var data = wiersz[7];
                            
                                i++;
                            var classKolor = "oferty__tabela--kolor"+(i%4);
                            tabele.innerHTML+= `
<table class='oferty__tabela `+classKolor+`'>
    <tr class='oferty__wiersz'>
        <td rowspan=5 class="oferty__cellNr"><b>`+i+`</b></td>
        <td class="oferty__cell"><b>Województwo</b></td>
        <td class="oferty__cell"><b>Powiat</b></td>
        <td class="oferty__cell"><b>Gmina</b></td>
        <td rowspan=5 class="oferty__tableOpis"><b>OPIS:</b> `+kom+`</td>
    </tr>
    <tr class='oferty__wiersz'>
        <td class="oferty__cell oferty__cell--borBott oferty__woj" value="`+woj+`"></td>
        <td class="oferty__cell oferty__cell--borBott oferty__pow" value="`+pow+`"></td>
        <td class="oferty__cell oferty__cell--borBott oferty__gmi" value="`+gmi+`"></td>
    </tr>
    <tr class='oferty__wiersz'>
        <td class="oferty__cell"><b>Miasto</b></td>
        <td class="oferty__cell"><b>Nick</b></td>
        <td class="oferty__cell"><b>Data</b></td>
    </tr>
    <tr class='oferty__wiersz'>
        <td class="oferty__cell oferty__cell--borBott">`+miasto+`</td>
        <td class="oferty__cell oferty__cell--borBott oferty__idUser" value="`+idUser+`"></td>
        <td class="oferty__cell oferty__cell--borBott">`+data+`</td>
    </tr>
    <tr  class='oferty__wiersz'>
        <td colspan=3 class="oferty__mailUser"><b>Kontakt:</b></td>
    </tr>
</table>`;
                        } 
                    //nadanie nazw
                    nadanieNazw();
                },
    });
}

    function nadanieNazw(){
          var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                
                    setNazwy(this);
                    elementyDoZmniejszania();
            }
          };
          xhttp.open("GET", "xml/xml.xml", true);
          xhttp.send();
        
            setNick();
    }

    function setNazwy(xml){
            var xmlDoc = xml.responseXML;
            var x = xmlDoc.getElementsByTagName("row");
            var woj;
            var pow;
            var gmi;
            var wojName;
            var powName;
            var gmiName;
            var wojEl = document.getElementsByClassName("oferty__woj");
            var powEl = document.getElementsByClassName("oferty__pow");
            var gmiEl = document.getElementsByClassName("oferty__gmi");
        
        var wiersze = document.getElementsByClassName("oferty__woj");
        var ile = wiersze.length;
        
        for(var i=0; i<ile; i++){
            wojName=null;
            powName=null;
            gmiName=null;
            woj = wojEl[i].getAttribute("value");
            pow = powEl[i].getAttribute("value");
            gmi = gmiEl[i].getAttribute("value");
            
            for(var j=0; j<x.length && ( wojName==null || powName==null || gmiName==null); j++){
                
                if(x[j].getElementsByTagName("NAZWA_DOD")[0].childNodes[0].nodeValue.indexOf("województwo") != -1 &&
                    x[j].getElementsByTagName("WOJ")[0].childNodes[0].nodeValue == woj){
                    wojName = x[j].getElementsByTagName("NAZWA")[0].childNodes[0].nodeValue;
                }
                if(x[j].getElementsByTagName("NAZWA_DOD")[0].childNodes[0].nodeValue.indexOf("powiat") != -1 &&
                   x[j].getElementsByTagName("WOJ")[0].childNodes[0].nodeValue == woj &&
                    x[j].getElementsByTagName("POW")[0].childNodes[0].nodeValue == pow){
                    powName = x[j].getElementsByTagName("NAZWA")[0].childNodes[0].nodeValue;
                }
                if(x[j].getElementsByTagName("NAZWA_DOD")[0].childNodes[0].nodeValue.indexOf("gmina") != -1 &&
                   x[j].getElementsByTagName("WOJ")[0].childNodes[0].nodeValue == woj &&
                    x[j].getElementsByTagName("POW")[0].childNodes[0].nodeValue == pow &&
                    x[j].getElementsByTagName("GMI")[0].childNodes[0].nodeValue == gmi){
                    gmiName = x[j].getElementsByTagName("NAZWA")[0].childNodes[0].nodeValue;
                }
        
            }
            
            wojEl[i].innerHTML = wojName;
            powEl[i].innerHTML = powName;
            gmiEl[i].innerHTML = gmiName;
            
            
        }
      elementyDoZmniejszania();
    }

    function setNick(){
        
        var idUserEl = document.getElementsByClassName("oferty__idUser");
        var mailUserEl = document.getElementsByClassName("oferty__mailUser");
        var ile = idUserEl.length;
        
        var j=0;
        
        setNickAjax(idUserEl, mailUserEl, ile, j);
        
        elementyDoZmniejszania();
        
      
}

function setNickAjax(idUserEl, mailUserEl, ile, j){
    
    $.ajax({
                    type:"GET", 
                    url:"php/getOfertySzcz.php", 
                    contentType:"application/json; charset=utf-8", 
                    dataType:'json',
                    data: {idUser:idUserEl[j].getAttribute("value")},


                        success: function(nick) { 
                            idUserEl[j].innerHTML = nick[0][0];
                            mailUserEl[j].innerHTML ="<b>Kontakt:</b> "+ nick[0][1];
                            j++;
                            if(j<ile)
                                setNickAjax(idUserEl, mailUserEl, ile, j);
                        },
            
        });
    
}
