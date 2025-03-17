enableTableEdit('Pages/backoffice/php/editTable.php', 'table-#objets', 'objets');
enableTableEdit('Pages/backoffice/php/editTable.php', 'table-#inventaires', 'inventaires');
enableTableEdit('Pages/backoffice/php/editTable.php', 'table-#argents', 'argents');
enableTableEdit('Pages/backoffice/php/editTable.php', 'table-#joueurs', 'joueurs');
enableTableEdit('Pages/backoffice/php/editTable.php', 'table-#personnages', 'personnages');
enableTableEdit('Pages/backoffice/php/editTable.php', 'table-#monstres', 'monstres');
enableTableEdit('Pages/backoffice/php/editTable.php', 'table-#stats', 'stats');
enableTableEdit('Pages/backoffice/php/editTable.php', 'table-#compétences', 'compétences');
enableTableEdit('Pages/backoffice/php/editTable.php', 'table-#metier', 'metier');
enableTableEdit('Pages/backoffice/php/editTable.php', 'table-#maitrise', 'maitrise');
enableTableEdit('Pages/backoffice/php/editTable.php', 'table-#lore', 'lore');
enableTableEdit('Pages/backoffice/php/editTableColumn.php', 'table-#compétences-column', 'compétences');
enableTableEdit('Pages/backoffice/php/editTableColumn.php', 'table-#maitrise-column', 'maitrise');
enableTableEdit('Pages/backoffice/php/editTableColumn.php', 'table-#metier-column', 'metier');
enableTableEdit('Pages/backoffice/php/editTable.php', 'table-#stats_by_carac', 'stats_by_carac');
enableTableEdit('Pages/backoffice/php/editTable.php', 'table-#sorts', 'sorts');
enableTableEdit('Pages/backoffice/php/editTable.php', 'table-#sorts_par_joueurs', 'sorts_par_joueurs');
enableTableEdit('Pages/backoffice/php/editTable.php', 'table-#techniques', 'techniques');
enableTableEdit('Pages/backoffice/php/editTable.php', 'table-#techniques_par_joueurs', 'techniques_par_joueurs');
enableTableEdit('Pages/backoffice/php/editTable.php', 'table-#feats_for_players', 'feats_for_players');
enableTableEdit('Pages/backoffice/php/editTable.php', 'table-#feats', 'feats');



document.addEventListener("click", function(event) {
    if (event.target.matches(".delete-button")) {
        event.preventDefault();

        if (confirm("Êtes-vous sûr de vouloir supprimer cette définitivement cette ligne ? \nCe changement ne pourra pas être annulé.")) {
            event.target.closest("form").submit();
        }
    }
});

const background = document.getElementById('modal-background');
background.addEventListener('click', fermerModal);


function afficherModal(url){
    const modal = document.getElementById('modal-formulaire');
    const background = document.getElementById('modal-background');
    const content = document.getElementById('modal-content');

    modal.style.top = "5%";
    background.style.display = 'block';

    setTimeout(() => {
        background.style.opacity = '1';
    }, 1);

    fetch('Pages/backoffice/php/add/'+url+'.php')
    .then(response => response.text())
    .then(data => {
        content.innerHTML = data;
    });
}

function fermerModal(){
    const modal = document.getElementById('modal-formulaire');
    const background = document.getElementById('modal-background');

    modal.style.top = "-100%";
    background.style.opacity = '0';

    setTimeout(() => {
        background.style.display = 'none';
    }, 350)
}

function afficherDebug(){
    const sectionDebug = document.getElementById('section-debug');

    sectionDebug.style.display = 'block';
    setTimeout(() => {
        window.scrollTo(0, document.body.scrollHeight);
    }, 10)
}

document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') {
        fermerModal();
    }
});

function searching(idTable, idSearch) {
    // Récupérer la table et le champ de recherche
    const table = document.getElementById(idTable);
    const searchInput = document.getElementById(idSearch);
    const searchTerm = searchInput.value.toLowerCase(); // Convertir en minuscules pour une recherche insensible à la casse

    // Récupérer toutes les lignes de la table (sauf l'en-tête)
    const rows = table.getElementsByTagName('tr');

    // Parcourir toutes les lignes (en commençant par l'index 1 pour ignorer l'en-tête)
    for (let i = 1; i < rows.length; i++) {
        const row = rows[i];
        const cells = row.getElementsByTagName('td');
        let found = false;

        // Parcourir toutes les cellules de la ligne
        for (let j = 0; j < cells.length; j++) {
            const cellText = cells[j].textContent.toLowerCase();

            // Vérifier si le texte de la cellule contient le terme de recherche
            if (cellText.includes(searchTerm)) {
                found = true;
                break; // Si une correspondance est trouvée, on peut arrêter la recherche pour cette ligne
            }
        }

        // Afficher ou masquer la ligne en fonction de la recherche
        if (found) {
            row.style.display = ''; // Afficher la ligne
        } else {
            row.style.display = 'none'; // Masquer la ligne
        }
    }
}


// Gestionnaire pour les objets
document.addEventListener('change', (event) => {
if (event.target && event.target.id === 'select-form-objets') {
    const inputObjets = document.getElementById('input-form-objets');
    inputObjets.value = event.target.value;
}
});

// Gestionnaire pour les joueurs
document.addEventListener('change', (event) => {
if (event.target && event.target.id === 'select-form-appartenance') {
    const inputAppartenance = document.getElementById('input-form-appartenance');
    inputAppartenance.value = event.target.value;
}
});

// Gestionnaire pour l'argents
document.addEventListener('change', (event) => {
    if (event.target && event.target.id === 'select-form-appartenance-ARGENTS') {
        const inputAppartenance = document.getElementById('input-form-appartenance-ARGENTS');
        inputAppartenance.value = event.target.value;
    }
});

// Gestionnaire pour les joueurs
document.addEventListener('change', (event) => {
    if (event.target && event.target.id === 'select-form-nom-JOUEURS') {
        const inputAppartenance = document.getElementById('input-form-nom-JOUEURS');
        inputAppartenance.value = event.target.value;
    }
});

document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();

        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});