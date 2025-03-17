const burger = document.getElementsByClassName('burger');
const header = document.getElementsByClassName('header');
window.addEventListener('load', adjustBackgroundHeight);
window.addEventListener('resize', adjustBackgroundHeight);

function burgerMenu(){    
    header[0].style.display = 'block';
    burger[0].style.display = 'none';
}

function closeMenu(){
    header[0].style.display = 'none';
    burger[0].style.display = 'block';
}

const deconnexion = document.getElementById('disconnected');

deconnexion.addEventListener('click', ()=>{
  if(confirm('Voulez-vous vraiment vous déconnecter ?')){
    window.location.href = "Commun/deconnexion.php";
  }
});

function adjustBackgroundHeight() {
  const background = document.getElementById('soft-neige');
  const pageHeight = document.documentElement.scrollHeight; // Hauteur totale de la page
  background.style.height = `${pageHeight}px`;
}


