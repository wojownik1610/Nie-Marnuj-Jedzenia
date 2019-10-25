window.onload = function(){
    document.getElementsByClassName("form__przycisk")[0].addEventListener("click", function(){submitRejestr();});
    
            document.getElementById("nazwa").addEventListener("keyup", function(){isValid(this);});
            document.getElementById("login").addEventListener("keyup", function(){isValid(this);});
            document.getElementById("mail").addEventListener("keyup", function(){isValid(this);});
            document.getElementById("haslo").addEventListener("keyup", function(){isValid(this);});
            document.getElementById("haslo2").addEventListener("keyup", function(){isValid(this);});

}
  
 
    function submitRejestr(){
        
                var poprawny = 0;
                poprawny += isFinishValid("nazwa");
                poprawny += isFinishValid("login");
                poprawny += isFinishValid("mail");
                poprawny += isFinishValid("haslo");
                poprawny += isFinishValid("haslo2");
        
                if(poprawny == 5) document.forms["rejestr"].submit();
    }
        
        function isFinishValid(id){
            var el = document.getElementById(id);
            var el2 = document.getElementById("n_"+id);
            var el3 = document.getElementById("k_"+id);
            var elReg = setReg(el);
            
            if( elReg.test(el.value) && ((el.value == document.getElementById("haslo").value && id == "haslo2") || id != "haslo2")  ){

                el3.classList.add("icon-ok-circled");
                el3.classList.remove("icon-cancel-circled");
                el2.innerHTML = "";
                return 1;
            }
            else{
                el3.classList.add("icon-cancel-circled");
                el3.classList.remove("icon-ok-circled");
                var el2Nap;
                
                    el.classList.add("form__pole--bgRed");
                    if(el.value == "") el2Nap = "Pole wymagane.";
                    else {

                        switch(id){
                                case "nazwa":
                                    el2Nap = "Nazwa musi mieć od 5 do 20 znaków, może składać się tylko z liter i cyfr.";
                                    break;
                                case "login":
                                    el2Nap = "Nazwa musi mieć od 5 do 20 znaków, może składać się tylko z liter i cyfr.";
                                    break;
                                case "mail":
                                    el2Nap = "Podaj poprawny mail.";
                                    break;
                                case "haslo":
                                    el2Nap = "Hasło musi mieć od 8 do 24 znaków.";
                                    break;
                                case "haslo2":
                                    el2Nap = "Hasła muszą być identyczne.";
                                    break;
                        }
                    }
                
                el2.innerHTML = el2Nap;
                return 0;
            };
        }
        function isValid(el){
            var elReg = setReg(el);
            
            if(el == "haslo2"){
                if(document.getElementById("haslo").value == document.getElementById("haslo2").value){
                    if(elReg.test(el.value)){
                        el.classList.add("form__pole--bgGreen");
                        el.classList.remove("form__pole--bgRed");
                        return;
                    }
                }
                
                el.classList.remove("form__pole--bgGreen");
                return;
            }
            
            if(elReg == 0){
                if(el.id == "usluga"){
                    if(el.value > 0) el.classList.remove("form__pole--bgRed");
                }
                else{
                    if(el.checked) el.parentElement.classList.remove("form__labelCheck--borderRed");
                }
                return;
            }
            if(elReg.test(el.value)){
                el.classList.add("form__pole--bgGreen");
                el.classList.remove("form__pole--bgRed");
            }
            else{
                el.classList.remove("form__pole--bgGreen");
            }
        }
        function setReg(el){
            var elReg;
            switch(el.id){
                case "nazwa":
                    elReg = /^[A-ZĄĆĘÓŁŚŹŻa-ząęćżźłó0-9]{5,20}$/;
                    break;
                case "login":
                    elReg = /^[A-ZĄĆĘÓŁŚŹŻa-ząęćżźłó0-9]{5,20}$/;
                    break;
                case "mail":
                    elReg = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                    break;
                case "haslo":
                case "haslo2":
                    elReg = /^[A-ZĄĆĘÓŁŚŹŻa-ząęćżźłó0-9!#%*+/*~.]{8,24}$/;
                    break;
                default:
                    elReg = 0;
            }
            return elReg;
        }