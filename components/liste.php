<section class="container pt-5" id="todolist">
    <br>
    <form id="creationTache" class="pb-4">
    <div class="form-group">
        <label for="nomTache">Nouvelle tâche</label>
        <input required="" class="form-control" type="text" id="nomTache" placeholder="Tâche à faire" name="title" style="width: 80%">
    </div>
    <div class="form-group d-flex">
        <div class="mr-2" style="flex: 1;">
            <label for="dateTache">Date</label>
            <input required="" type="date" id="dateTache" class="form-control" style="width: 60%;">
        </div>
        <div style="flex: 1;">
            <label for="priorite">Priorité</label>
            <select id="priorite" name="priorite" class="form-control" style="width: 60%;">
                <option value="basse">Basse</option>
                <option value="moyenne">Moyenne</option>
                <option value="haute">Haute</option>
            </select>
        </div>
    </div>
    <div class="form-group mt-2">
        <button id="btnAjouter" class="btn btn-dark">Ajouter</button>
    </div>
</form>

        <main>
            <br>
            <div class="btn-group mb-4" role="group">
                <button type="button" class=" btn btn-outline-dark active" data-filter="all">Toutes</button>
                <button type="button" class=" btn btn-outline-dark" data-filter="todo">A faire</button>
                <button type="button" class=" btn btn-outline-dark" data-filter="done">Faites</button>
            </div>
            <ul class="list-group" id="listeTaches">
    <!-- Les tâches seront ajoutées ici dynamiquement via JavaScript -->
</ul>
        </main>
    </section>