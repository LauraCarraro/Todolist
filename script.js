document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("btnAjouter").addEventListener("click", function (event) {
        event.preventDefault(); // Empêche le formulaire de se soumettre normalement

        // Récupérer les valeurs du formulaire
        var nomTache = document.getElementById("nomTache").value;
        var dateTache = document.getElementById("dateTache").value;
        var priorite = document.getElementById("priorite").value;

        // Créer un nouvel élément li
        var newTask = document.createElement("li");
        newTask.className = "todo list-group-item d-flex align-items-center";

        // Créer le contenu de la nouvelle tâche avec la date d'échéance et la priorité
        newTask.innerHTML = `
            <input class="form-check-input" type="checkbox">
            <label class="ms-2 form-check-label">
                <strong>${nomTache}</strong>
                <span class="text-muted ms-2">Date d'échéance: ${dateTache}</span>
                <span class="ms-2">Priorité: ${priorite}</span>
            </label>
            <label class="ms-auto btn btn-danger btn-sm delete-task">
                <i class="bi-trash"></i>
            </label>
        `;

        // Ajouter la nouvelle tâche à la liste
        var taskList = document.getElementById("listeTaches");
        taskList.appendChild(newTask);

        // Effacer les champs du formulaire
        document.getElementById("nomTache").value = "";
        document.getElementById("dateTache").value = "";
        document.getElementById("priorite").value = "basse"; 
    });

    // Supprimer la tâche en cliquant sur l'icône "corbeille"
    document.getElementById("listeTaches").addEventListener("click", function (event) {
        if (event.target.classList.contains("delete-task")) {
            var taskToRemove = event.target.closest("li.todo");
            if (taskToRemove) {
                taskToRemove.remove();
            }
        }
    });
    });
