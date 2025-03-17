var currentModal = null;

document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') {
        fermerModal(currentModal);
    }
});


function afficherInput(id){
    
    const input = document.getElementById("id-"+id);
    const checkbox = document.getElementById(id);

    if(checkbox.checked == true) input.style.display = 'flex';
    else input.style.display = 'none';    
}

function updateDatabase(label, titre) {

    
    let newValue = document.getElementById(label).value;
    newValue = parseInt(newValue, 10);

    console.log(newValue);
    let id = document.getElementById('personnage-nom').innerHTML;

    if (newValue < 0) newValue = 0;
    if (newValue > 100) newValue = 100;

    

    let table = "";

    switch (titre) {
        case 'Statistiques':
            table = 'stats';
            break;
        case 'Maîtrises':
            table = 'maitrise';
            break;
        case 'Compétences':
            table = 'compétences';
            break;
        case 'Métiers':
            table = 'metier';
            break;
    }

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "Pages/fichePersonnage/php/updateDatabase.php", true);
    xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    xhr.onload = function () {
        if (xhr.status === 200) {
            console.log("Mise à jour réussie :", xhr.responseText);
        } else {
            console.error("Erreur lors de la mise à jour :", xhr.responseText);
            // Revenir à l'ancienne valeur si erreur
            td.textContent = originalValue;
        }
    };
    xhr.send(JSON.stringify({ table: table, column: label, value: newValue, id: id}));
}

function afficherModal(titre){
    const modal = document.getElementById(`${titre}-modal`);
    const background = document.getElementById('modal-background');
    currentModal = titre;

    modal.style.top = "50%";
    background.style.display = 'block';

    setTimeout(() => {
        background.style.opacity = '1';
    }, 1);
}

function fermerModal(titre){
    const modal = document.getElementById(`${titre}-modal`);
    const background = document.getElementById('modal-background');

    modal.style.top = "-100%";
    background.style.opacity = '0';

    setTimeout(() => {
        background.style.display = 'none';
    }, 350)
}