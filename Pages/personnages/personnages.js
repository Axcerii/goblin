
    document.addEventListener('DOMContentLoaded', function() {
        setCategorie();
        switchCategorie();
        let aujourdhui = new Date().getTime();
      
        if(localStorage.getItem('descendance') && aujourdhui - localStorage.getItem('Personnages_timestamp') < 600000){
          setDescendance();
        }
      
        var descendanceDiv = document.querySelector(".descendance");
      
        descendanceDiv.addEventListener("change", function(event) {
            if (event.target.type === "checkbox") {
              
                if(event.target.id == 'aucun'){
                  uncheckedAutres();
                }
                else{
                  document.getElementById('aucun').checked = false;
                }
      
                var descendanceChecked = descendanceDiv.querySelectorAll('input[type="checkbox"]:checked'),
                stringDescendance = "";
      
                descendanceChecked.forEach(function(checkbox){
                  stringDescendance += checkbox.id + "-";
                })
      
                localStorage.setItem('descendance', stringDescendance);
      
                /* Disparition des cartes */
      
                var cards = document.getElementsByClassName('card');
      
                for(let ii = 0; ii < cards.length; ii++){
                  var descendanceCard = cards[ii].getElementsByClassName("descendance-value")[0];
                  var texte = descendanceCard.textContent;
      
                  if(descendanceValidator(texte, stringDescendance)){
                    cards[ii].style.display = "";
                  }
                  else{
                    cards[ii].style.display = "none";
                  }
                }
            }
        });
      
        var checkboxes = descendanceDiv.querySelectorAll('input[type="checkbox"]:checked');
        checkboxes.forEach(function(checkbox) {
          var event = new Event('change', {
            bubbles: true,
            cancelable: true
          });
          checkbox.dispatchEvent(event);
        });
      });
      
      
      function myFunction() {
          var input, filter, ul, li, a, i, txtValue;
          input = document.getElementById('search_bar');
          filter = input.value.toUpperCase();
          ul = document.getElementById("MainZoneCard");
          li = ul.getElementsByClassName('card');
      
          for (i = 0; i < li.length; i++) {
            a = li[i].getElementsByTagName("p")[0];
            txtValue = a.textContent || a.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
              li[i].style.display = "";
            } else {
              li[i].style.display = "none";
            }
          }
      
          ul2 = document.getElementById("BestiaireZoneCard");
          li2 = ul2.getElementsByClassName('card');
      
          for (i = 0; i < li2.length; i++) {
            a = li2[i].getElementsByTagName("p")[0];
            txtValue = a.textContent || a.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
              li2[i].style.display = "";
            } else {
              li2[i].style.display = "none";
            }
          }

          ul3 = document.getElementById("PlayerZoneCard");
          li3 = ul3.getElementsByClassName('card');
      
          for (i = 0; i < li3.length; i++) {
            a = li3[i].getElementsByTagName("p")[0];
            txtValue = a.textContent || a.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
              li3[i].style.display = "";
            } else {
              li3[i].style.display = "none";
            }
          }
        }
      
        function addScript(url){
          var script = document.createElement('script');
          script.src = url;
          document.body.appendChild(script);
        }
      
      function switchCategorie(){
        const radioPersonnages = document.getElementById('personnages');
        const radioBestiaire = document.getElementById('bestiaire');
        const radioPlayer = document.getElementById('player');
      
        const cardPersonnages = document.getElementById('MainZoneCard');
        const cardBestiaire = document.getElementById('BestiaireZoneCard');
        const cardPlayer = document.getElementById('PlayerZoneCard');
      
        if(radioPersonnages.checked){
          cardPersonnages.style.display = 'grid';
          cardBestiaire.style.display = 'none';
          cardPlayer.style.display = 'none';
          localStorage.setItem('categorie', 'personnages');
        }
        else if(radioBestiaire.checked){
          cardBestiaire.style.display = 'grid';
          cardPersonnages.style.display = 'none';
          cardPlayer.style.display = 'none';
          localStorage.setItem('categorie', 'bestiaire');
        }
        else if(radioPlayer.checked){
          cardPlayer.style.display = 'grid';
          cardPersonnages.style.display = 'none';
          cardBestiaire.style.display = 'none';
          localStorage.setItem('categorie', 'player');
        }
      }
      
      function setCategorie(){
        var categorie = localStorage.getItem('categorie');
      
        if(categorie == 'personnages'){
          $('#personnages').prop('checked', true);
          $('#bestiaire').prop('checked', false);
        }
        else if(categorie == 'bestiaire'){
          $('#bestiaire').prop('checked', true);
          $('#personnages').prop('checked', false);
        }
        else if(categorie == 'player'){
          $('#player').prop('checked', true);
          $('#personnages').prop('checked', false);
        }
      }
      
      function descendanceValidator(cardValue, checkbox){
        var cardValues = cardValue.toUpperCase().split('-');
        var checkboxes = checkbox.toUpperCase().split('-');
      
      
        /* Transformation en Tableau Double */
        for(let ii = 0; ii < cardValues.length; ii++){
          cardValues[ii] = [cardValues[ii], false];
        }
      
        for(let ii = 0; ii < checkboxes.length; ii++){
          checkboxes[ii] = [checkboxes[ii], false];
        }
      
        checkboxes.splice(checkboxes.length-1);
      
      /*console.table(checkboxes); */
      
        /* On vérifie s'il y a plus de catégorie cocher que celle présent dans la carte */
        if(checkboxes.length > cardValues.length){
          return false;
        } 
      
        /* Sinon on vérifie chaque coté du tableau */
      
        else{
          for(let ii = 0; ii < cardValues.length; ii++){
            for(let jj = 0; jj < checkboxes.length; jj++){
              if(cardValues[ii][0] == checkboxes[jj][0]){
                cardValues[ii][1] = true;
                checkboxes[jj][1] = true;
              }
            }
          }
        }
      
        /* Et enfin si tout est bon dans le tableau checkboxes on retourne false sinon true */
      
        for(let ii = 0; ii < checkboxes.length; ii++){
          if(checkboxes[ii][1] == false){
            return false
          }
        }
      
        return true;
      }
      
      function uncheckedAutres(){
        var descendance = document.querySelector('.descendance');
        var checkboxes = descendance.querySelectorAll("input[type='checkbox']");
      
        checkboxes.forEach(function(checkbox){
          if(checkbox.id !== "aucun"){
            checkbox.checked = false;
          }
        });
      }
      
      function setDescendance(){
        var localDescendance = localStorage.getItem('descendance');
      
        localDescendance = localDescendance.split('-');
        localDescendance.splice(localDescendance.length-1);
      
        for(let ii = 0; ii < localDescendance.length; ii++){
          document.getElementById(localDescendance[ii]).checked = true;
        }
      }