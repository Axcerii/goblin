const menu = document.getElementById("menu");
const carreImg = document.getElementById('fill-img');
const paragraph = document.getElementById('paragraph');

const descriptionPersonnage = 'Liste des personnages connus de votre Ascension';
const descriptionLore = 'Accès aux différents éléments du lore de l\'Ascension ';
const descriptionProfil = 'Permet l\'accès à votre profil, vos statistiques, objets et pièces d\'or.';
/* const descriptionAssets = 'Documents sur les assets que j\'utilise pour le JDR avec leurs explications'; */

const descriptions = [descriptionPersonnage, descriptionLore, descriptionProfil];

var link = ['Pages/index/Images/JapaneseGoblin.jpg', 'Pages/index/Images/JapaneseGoblin.jpg', 'Pages/index/Images/JapaneseGoblin.jpg'];

Array.from(document.getElementsByClassName('menu-links')).forEach((item, index) => {
    item.onmouseover = () => {
        
        if(typeof window.timer != 'undefined'){
            clearInterval(window.timer);
        }

        var string = descriptions[index];
        speed = 20;


        menu.dataset.activeIndex = index;
        carreImg.src = link[index];

       if(typeof timer != 'undefined'){
           clearInterval(timer);    
       }

       paragraph.textContent = '';
       string.split('');
       var ii = 0;
   
   
       window.timer = setInterval(()=>{
           if(ii < string.length){
               paragraph.textContent += string[ii];
               ii++
           }
           else{
               clearInterval(window.timer);
           }
       }, speed);
    }
});

