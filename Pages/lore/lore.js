document.addEventListener('DOMContentLoaded', function () {
    const textarea = document.getElementById('editor-textarea');
    const highlighter = document.getElementById('editor-highlighter');

    // Fonction pour échapper les caractères spéciaux HTML
    function escapeHTML(text) {
        return text
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    // Fonction pour ajouter les styles colorés
    function highlightText(text) {
        // Échapper les caractères HTML pour éviter les problèmes
        text = escapeHTML(text);

        // Ajouter les styles pour chaque type de balise
        text = text
            .replace(/§b (.*?) §/g, '<span class="highlight-bold">$1</span>')
            .replace(/§t1 (.*?) §/g, '<span class="highlight-title1">$1</span>')
            .replace(/§t2 (.*?) §/g, '<span class="highlight-title2">$1</span>')
            .replace(/§t3 (.*?) §/g, '<span class="highlight-title3">$1</span>')
            .replace(/§image (.*?) §/g, '<span class="highlight-image"><img src="Pages/lore/images/$1" alt="$1" style="display:flex; margin: auto; width: 50%;"></span>');

        // Retourner le texte transformé
        return text.replace(/\n/g, '<br>'); // Conserver les retours à la ligne
    }

    // Synchroniser le texte entre la textarea et le highlighter
    function syncHighlighting() {
        const content = textarea.value;
        highlighter.innerHTML = highlightText(content);

        // Synchroniser la hauteur de la textarea et du highlighter
        highlighter.style.height = textarea.scrollHeight + 'px';
    }

    // Événements pour mettre à jour la coloration en temps réel
    textarea.addEventListener('input', syncHighlighting);
    textarea.addEventListener('scroll', function () {
        highlighter.scrollTop = textarea.scrollTop;
    });

    // Initialiser le contenu
    syncHighlighting();



    ///////////////////////
    /* Ajouter une Image */
    //////////////////////

    document.querySelector('#add-image-button').addEventListener('click', (event) => {
        event.preventDefault(); // Empêche le comportement par défaut du formulaire
    
        const inputFile = document.querySelector('#image-file');
        const messageElement = document.getElementById('imageMessages');
    
        if (!inputFile.files.length) {
            messageElement.innerHTML = "Veuillez sélectionner un fichier.";
            return;
        }
    
        const file = inputFile.files[0];
        const formData = new FormData();
        const names = document.getElementById('image-names');
        formData.append('image', file);
    
        // Envoi en AJAX
        fetch('Pages/lore/php/imageValidator.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    messageImageDisplay(data.message, true);
                    inputFile.value = '';
                    names.innerHTML += `<p>§image ${file.name} §</p>`;
                } else {
                    messageImageDisplay(data.message, false);
                    inputFile.value = '';
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
            });
    });

    function messageImageDisplay(text, boolean){
        const messageElement = document.getElementById('imageMessages');
        if(boolean){
            messageElement.style.color = "green";
        }else{
            messageElement.style.color = "red";
        }

        messageElement.innerHTML = `${text}`;
        
        messageElement.style.bottom = "0";
        setTimeout(() => {
            messageElement.style.bottom = "-50%";
        }, 5000);
    }
});

