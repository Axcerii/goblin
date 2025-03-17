function enableTableEdit(url, tableId, tableName) {
    const table = document.getElementById(tableId);

    if (!table) {
        console.error(`Table avec l'ID "${tableId}" introuvable.`);
        return;
    }

    // Écouter les événements de double clic sur les cellules du tableau
    table.addEventListener("dblclick", (event) => {
        const td = event.target;

        // Vérifier que l'élément ciblé est une cellule <td> et pas un <th>
        if (td.tagName !== "TD" || td.classList.contains("td-id")) return;

        // Sauvegarder la valeur originale
        const originalValue = td.textContent.trim();

        // Créer un champ <input> avec la valeur actuelle
        const input = document.createElement("textarea");
        //input.type = "text";
        input.value = originalValue;
        td.textContent = "";
        td.appendChild(input);
        input.focus();

        // Gérer la validation de l'édition
        const saveEdit = () => {
            const newValue = input.value.trim();

            // Remettre la valeur dans le <td>
            td.textContent = newValue;

            // Si la valeur n'a pas changé, ne rien envoyer
            if (newValue === originalValue) return;

            // Obtenir l'ID de la ligne
            const row = td.parentElement;
            const idCell = row.querySelector(".td-id");
            if (!idCell) {
                console.error("Impossible de trouver l'ID de la ligne.");
                return;
            }

            const id = idCell.textContent.trim();

            // Obtenir le nom de la colonne à partir du <th>
            const columnIndex = td.cellIndex; // L'index de la colonne
            const th = table.querySelector(`th:nth-child(${columnIndex + 1})`); // Correspondant au <th>
            const columnName = th ? th.textContent.trim() : `column_${columnIndex}`;

            // Envoyer la mise à jour au serveur via AJAX
            const xhr = new XMLHttpRequest();
            xhr.open("POST", url, true);
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

            xhr.send(JSON.stringify({ table: tableName, id: id, column: columnName, value: newValue }));
            console.log("Envoi de la mise à jour :", { table: tableName, id: id, column: columnName, value: newValue });
        };

        // Sauvegarder en appuyant sur Entrée ou en cliquant ailleurs
        input.addEventListener("blur", saveEdit);
        input.addEventListener("keydown", (e) => {
            if (e.key === "Enter") {
                input.removeEventListener("blur", saveEdit); // Empêcher double appel
                saveEdit();
            }
        });
    });
}