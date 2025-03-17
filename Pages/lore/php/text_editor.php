<div id="editor-container">


    <div id="editor-wrapper">
        <!-- Élement miroir pour la coloration -->
         <div class="editor-textarea-container">
             <div class="categorie-container">
                 <select name="categorie1" id="categorie1" class='editor-input'>
                     <?php
                        $categorie = $db->executeSQL('SELECT categorie FROM lore GROUP BY categorie ORDER BY categorie');
                        
                        if(isset($categorie)){
                            foreach($categorie as $value){
                                echo "<option value='".$value['categorie']."'>".$value['categorie']."</option>";
                            }
                        }
                        ?>
                    <option value="0">Nouvelle Catégorie</option>
                </select>
                <input type="text" name="categorie2" readonly class="editor-input" id="categorie2" value="<?php 
                if(isset($categorie[0]['categorie'])){
                    echo $categorie[0]['categorie'];
                }
                ?>" required>
            </div>
            <input id='title' type="text" name="title" placeholder="Titre du récit" class="editor-input" required>
                <!-- Boutons pour insérer des balises -->
            <div id="editor-toolbar">
                <button type="button" onclick="addTag('§b ', ' §')"><span style='font-weight: bold'>B</span></button>
                <button type="button" onclick="addTag('§t1 ', ' §')">T1</button>
                <button type="button" onclick="addTag('§t2 ', ' §')">T2</button>
                <button type="button" onclick="addTag('§t3 ', ' §')">T3</button>
                <button type="button" onclick="addTag('§image ', ' §')">Image</button>
            </div>
            <textarea id="editor-textarea" name="content" rows="10" cols="50" placeholder="Entrez votre texte ici..."></textarea>
         </div>
         <div class="editor-preview">
             <h2 style="color: white; margin-bottom: 5px;">Preview : </h2>
             <pre id="editor-highlighter"></pre>
         </div>
        <!-- Zone de texte réelle -->
    </div>
</div>

<script>
// Fonction pour insérer des balises à la position du curseur
function addTag(openTag, closeTag) {
    const textarea = document.getElementById('editor-textarea');
    const start = textarea.selectionStart;
    const end = textarea.selectionEnd;
    const text = textarea.value;

    // Texte avant, sélectionné, et après le curseur
    const before = text.substring(0, start);
    const selected = text.substring(start, end);
    const after = text.substring(end);

    // Insère les balises autour du texte sélectionné
    textarea.value = before + openTag + selected + closeTag + after;

    // Replace le curseur après le tag ajouté
    textarea.selectionStart = textarea.selectionEnd = start + openTag.length + selected.length + closeTag.length;
    textarea.focus();
}

document.addEventListener('DOMContentLoaded', () => {
    const selectCategorie = document.getElementById('categorie1');
    const inputCategorie = document.getElementById('categorie2');

    if(selectCategorie.value === '0'){
        inputCategorie.value = '';
        inputCategorie.readOnly = false;
        inputCategorie.placeholder = "Tapez ici la nouvelle catégorie";
    }

    selectCategorie.addEventListener('change', () => {
        if (selectCategorie.value === '0') {
            inputCategorie.value = '';
            inputCategorie.readOnly = false;
            inputCategorie.placeholder = "Tapez ici la nouvelle catégorie";
        } else {
            inputCategorie.value = selectCategorie.value;
            inputCategorie.readOnly = true;
            inputCategorie.placeholder = "";
        }
    })
})

</script>

<style>
#editor-container {
    font-family: Arial, sans-serif;
    margin: 10px;
}
#editor-toolbar {
    margin-bottom: 5px;
}
#editor-toolbar button {
    margin-right: 5px;
    padding: 5px 10px;
    cursor: pointer;
    color: var(--firstColor);
    background-color: var(--thirdColor);
    font-family: Arial;
    font-size: 1.2em;
    border: none;
    border-radius: 5px;

    transition: all 0.1s ease-in-out;
}

#editor-toolbar button:hover {
    background-color: var(--secondColor);
}

#editor-textarea {
    width: 100%;
    height: 50vh;
    font-size: 14px;
    font-family: monospace;
    resize: vertical;
    margin-top: 1em;

    color: var(--white);
    background-color: rgba(255, 255, 255, 0.3);
    border: 2px solid var(--thirdColor);
    padding: 1em;
    border-radius: 1em;
    overflow: auto;
}

#editor-textarea::placeholder {
    color: var(--black);
}

#editor-wrapper{
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    width: 80%;
    margin: auto;
}


#editor-highlighter{
    width: 100%;
    height: 60vh;
    background-color: rgba(0, 0, 0, 0.3);
    border: 2px solid var(--thirdColor);
    padding: 1em;
    border-radius: 1em;
    overflow-x: hidden;
    overflow-y: auto;
    overflow-wrap: break-word;
    text-overflow: ellipsis;
    color: white;
    font-family: var(--mainFont);
    font-size: 1.2em;
    white-space: normal;
}

.editor-textarea-container{
    width: 45%;
}

.editor-preview{
    width: 40%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.editor-input{
    width: 40%;
    background-color: rgba(255, 255, 255, 0.3);
    border: 2px solid var(--thirdColor);
    padding: 0.5em;
    border-radius: 1em;
    overflow: auto;
    color: white;
    font-family: var(--mainFont);
    font-size: 1.2em;
    margin-bottom: 0.5em
}

.editor-input::placeholder{
    color: var(--black);
}

.editor-input > option{
    color: var(--black);
}

#categorie2::placeholder{
    color: var(--secondColor);
}

</style>