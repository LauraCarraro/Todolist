document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("btnAjouter").addEventListener("click", function (event) {
        event.preventDefault(); 

        // Récupérer les valeurs du formulaire
        let nomTache = document.getElementById("nomTache").value;
        let descriptionTache = document.getElementById("descriptionTache").value;
        let dateTache = document.getElementById("dateTache").value;
        let priorite = document.getElementById("priorite").value;
        let categorie = document.getElementById("categorie").value;

        // Créer un nouvel élément li
        let newTask = document.createElement("li");
        newTask.className = "todo list-group-item d-flex align-items-center";

        // Créer le contenu de la nouvelle tâche avec la date d'échéance et la priorité
        newTask.innerHTML = `
        <div class="tacheAFaire">
            <input class="form-check-input" type="checkbox">
            <label class="ms-2 form-check-label">
                <strong>${nomTache}</strong>
                <span class="ms-2">${descriptionTache}</span>
                <span class="text-muted ms-2">Date: ${dateTache}</span>
                <span class="ms-2">Priorité: ${priorite}</span>
                <span class="ms-2">Catégorie: ${categorie}</span>
            </label>
            <button class="btn btn-danger btn-sm supprimerTache">
                <i class="bi-trash"></i>
            </button>
        </div>
    `;

// Ajouter la nouvelle tâche à la liste
    let taskList = document.getElementById("listeTaches");
    taskList.appendChild(newTask);

// Sélectionnez tous les boutons de suppression de tâche
const boutonsSupprimer = document.querySelectorAll('.supprimerTache');
// Pour chaque bouton, ajoutez un écouteur d'événements au clic
boutonsSupprimer.forEach(bouton => {
    bouton.addEventListener('click', () => {
// Supprimez l'élément parent du bouton (c'est-à-dire la tâche)
        const tacheASupprimer = bouton.parentElement;
        tacheASupprimer.remove();
    });
});


// Effacer les champs du formulaire
    document.getElementById("nomTache").value = "";
    document.getElementById("descriptionTache").value = "";
    document.getElementById("dateTache").value = "";
    document.getElementById("priorite").value = "basse"; 
    document.getElementById("categorie").value = "personnel";
});


    // Ouvrir la modale de connexion
    document.getElementById('btnConnexion').addEventListener('click', function() {
        document.getElementById('modalConnexion').style.display = "block";
    });

    // Ouvrir la modale d'inscription
    document.getElementById('btnInscription').addEventListener('click', function() {
        document.getElementById('modalInscription').style.display = "block";
    });

    // Fermer la modale de connexion lorsqu'on clique sur le bouton croix
    document.querySelector('#modalConnexion .close').addEventListener('click', function() {
        document.getElementById('modalConnexion').style.display = "none";
    });

    // Fermer la modale d'inscription lorsqu'on clique sur le bouton croix
    document.querySelector('#modalInscription .close').addEventListener('click', function() {
        document.getElementById('modalInscription').style.display = "none";
    });

    // Fermer la modale de connexion lorsqu'on clique en dehors de celle-ci
    window.addEventListener('click', function(event) {
        if (event.target == document.getElementById('modalConnexion')) {
            document.getElementById('modalConnexion').style.display = "none";
        }
    });

    // Fermer la modale d'inscription lorsqu'on clique en dehors de celle-ci
    window.addEventListener('click', function(event) {
        if (event.target == document.getElementById('modalInscription')) {
            document.getElementById('modalInscription').style.display = "none";
        }
    });
});

  